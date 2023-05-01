<?php

defined('BASEPATH') or exit('No direct script access allowed');

include('application/models/bo/Ug.php');

class UgDAO extends CI_Model implements InterfaceCrudDAO {

    public static $TABELA_DB = 'ug';

    public function __construct() {
        parent::__construct();
    }

    public function criar($objeto) {
        $this->db->create(
                self::$TABELA_DB,
                $this->toArray($objeto),
                array('id' => $objeto->id)
        );
    }

    public function buscar($indiceInicial, $quantidadeMostrar) {

        $resultado = $this->db->get(
                self::$TABELA_DB,
                $quantidadeMostrar,
                $indiceInicial
        );

        $listaDeArtefatos = array();

        foreach ($resultado->result() as $linha) {

            $artefato = $this->toObject($linha);

            array_push($listaDeArtefatos, $artefato);
        }
        return $listaDeArtefatos;
    }

    public function buscarPorId($id) {

        $resultado = $this->db->get_where(
                self::$TABELA_DB,
                array('id' => $id)
        );

        foreach ($resultado->result() as $linha) {
            return $this->toObject($linha);
        }
    }

    public function atualizar($objeto) {
        $this->db->update(
                self::$TABELA_DB,
                $this->toArray($objeto),
                array('id' => $objeto->id)
        );
    }

    public function quantidade() {
        return $this->db->count_all_results(self::$TABELA_DB);
    }

    public function toArray($objeto) {
        return array(
            'id' => $objeto->id,
            'numero' => $objeto->numero,
            'nome' => $objeto->nome,
            'sigla' => $objeto->sigla,
            'status' => $objeto->status
        );
    }

    public function toObject($arrayList) {
        return new Artefato(
                $arrayList->id,
                $arrayList->nome,
                $arrayList->status
        );
    }

    
    public function ativar($objetoId) {
        $this->db->update(
                self::$TABELA_DB,
                array('id' => $objetoId),
                array('status' => true)
        );
    }
    
    public function desativar($objetoId) {
        $this->db->update(
                self::$TABELA_DB,
                array('id' => $objetoId),
                array('status' => false)
        );
    }

    public function options() {

        $artefatos = $this->retrive(null, null);

        $options = [];

        if (isset($artefatos)) {

            foreach ($artefatos as $key => $value) {

                $options += [$value->id => $value->nome . "(" . $value->numero . " - " . $value->sigla . ")"];
            }
        }
        return $options;
    }


}
