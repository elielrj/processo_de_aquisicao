<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('application/models/bo/Tipo.php');

include_once('InterfaceCrudDAO.php');

class TipoDAO extends CI_Model implements InterfaceCrudDAO {

    public static $TABELA_DB = 'tipo';

    public function __construct() {
        parent::__construct();
    }

    public function criar($objeto) {
        $this->db->create(
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

        $listaDeTipos = array();

        foreach ($resultado->result() as $linha) {

            $tipo = $this->toObject($linha);

            array_push($listaDeTipos, $tipos);
        }
        return $listaDeTipos;
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
        return $this->db
        ->where(array('status' => true))
        ->count_all_results(self::$TABELA_DB);
    }

    public function toArray($objeto) {
        return array(
            'id' => $objeto->id,
            'nome' => $objeto->nome,
            'status' => $objeto->status
        );
    }

    public function toObject($arrayList) {
        return new Tipo(
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

        $tipos = $this->buscar(null, null);

        $options = [];

        if (isset($tipos)) {

            foreach ($tipos as $key => $tipo) {

                $options += [$tipo->id => $tipo->nome];
            }
        }
        return $options;
    }

}
