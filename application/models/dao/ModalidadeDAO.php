<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('InterfaceCrudDAO.php');

class ModalidadeDAO extends CI_Model implements InterfaceCrudDAO {

    public static $TABELA_DB = 'modalidade';

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

        $listaDeModalidades = array();

        foreach ($resultado->result() as $linha) {

            $modalidade = $this->toObject($linha);

            array_push($listaDeModalidades, $modalidade);
        }
        
        return $listaDeModalidades;
    }

    public function buscarPorId($objetoId) {
        $resultado = $this->db
        ->get_where(
                self::$TABELA_DB,
                array('id' => $objetoId)
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

    public function desativar($objetoId) {
        return $this->db->update(
                        self::$TABELA_DB,
                        array('id' => $objetoId),
                        array('status' => false)
        );
    }

    public function ativar($objetoId) {
        return $this->db->update(
                        self::$TABELA_DB,
                        array('id' => $objetoId),
                        array('status' => true)
        );
    }

    public function quantidade() {
        return $this->db->count_all_results(self::$TABELA_DB);
    }

    //todo mover para Lei
    public function options() { 
        $modalidade = $this->buscar(null, null);

        $options = [];

        if (isset($modalidade)) {

            foreach ($modalidade as $key => $value) {

                $options += [$value->id => $value->nome . ' (' . 'Lei ' . $value->lei->toString() . ')'];
            }
        }
        return $options;
    }

    public function toArray($objeto) {
        return array(
            'id' => $objeto->id,
            'nome' => $objeto->nome,
            'status' => $objeto->status,
        );
    }

    public function toObject($arrayList) {
        return new Modalidade(
                $arrayList->id,
                $arrayList->nome,
                $arrayList->status
        );
    }

}
