<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('application/models/bo/Lei.php');
include_once('InterfaceCrudDAO.php');

class LeiDAO extends CI_Model implements InterfaceCrudDAO {

    public static $TABELA_DB = 'lei';

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

        $listaDeLeis = array();

        foreach ($resultado->result() as $linha) {

            $lei = $this->toObject($linha);

            array_push($listaDeLeis, $lei);
        }
        return $listaDeLeis;
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

        $leis = $this->retrive(null, null);

        $options = [];

        if (isset($leis)) {

            foreach ($leis as $key => $value) {

                $options += [$value->id => $value->nome . "(" . $value->numero . " - " . $value->artigo . " - " . $value->inciso . ")"];
            }
        }
        return $options;
    }

}
