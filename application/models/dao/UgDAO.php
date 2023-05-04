<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('application/models/bo/Ug.php');
include_once('InterfaceCrudDAO.php');

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

        $resultado = $this->db
        ->where(array('status' => true))
        ->get(
                self::$TABELA_DB,
                $quantidadeMostrar,
                $indiceInicial
        );

        $listaDeUgs = array();

        foreach ($resultado->result() as $linha) {

            $ug = $this->toObject($linha);

            array_push($listaDeUgs, $ug);
        }
        return $listaDeUgs;
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
        return new Ug(
                $arrayList->id,
                $arrayList->numero,
                $arrayList->nome,
                $arrayList->sigla,
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

        $ugs = $this->retrive(null, null);

        $options = [];

        if (isset($ugs)) {

            foreach ($ugs as $key => $ug) {

                $options += [$ug->id => $ug->toString()];
            }
        }
        return $options;
    }


}
