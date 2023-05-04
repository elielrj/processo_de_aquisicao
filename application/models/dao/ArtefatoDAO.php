<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('application/models/bo/Artefato.php');
include_once('InterfaceCrudDAO.php');

class ArtefatoDAO extends CI_Model implements InterfaceCrudDAO {

    public static $TABELA_DB = 'artefato';

    public function __construct() {
        parent::__construct();
    }

    public function criar($objeto) {

        $this->db->insert(
                self::$TABELA_DB,
                $this->toArray($objeto)
        );
    }

    public function buscar($indiceInicial, $quantidadeMostrar) {

        $resultado = $this->db
        ->where(array('status' => true))
        ->get(
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

    public function buscarPorId($objetoId) {

        $resultado = $this->db->get_where(
                self::$TABELA_DB,
                array('id' => $objetoId)
        );

        foreach ($resultado->result() as $linha) {

            return $this->toObject($linha);
        }
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

    public function options() {

        $artefatos = $this->buscar(null, null);

        $options = [];

        if (isset($artefatos)) {

            foreach ($artefatos as $key => $value) {

                $options += [$value->id => $value->nome];
            }
        }
        return $options;
    }

    public function toArray($objeto) {
        return array(
            'id' => $objeto->id,
            'ordem' => $objeto->ordem,
            'nome' => $objeto->nome,
            'status' => $objeto->status
        );
    }

    public function toObject($arrayList) {
        return new Artefato(
                $arrayList->id,
                $arrayList->ordem,
                $arrayList->nome,
                null,
                $arrayList->status
        );
    }

}
