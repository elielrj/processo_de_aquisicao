<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('application/models/bo/Departamento.php');
include_once('InterfaceCrudDAO.php');

class DepartamentoDAO extends CI_Model implements InterfaceCrudDAO {

    public static $TABELA_DB = 'departamento';

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

        $resultado = $this->db->get(
                self::$TABELA_DB,
                $quantidadeMostrar,
                $indiceInicial
        );

        $listaDeDepartamentos = array();

        foreach ($resultado->result() as $linha) {

            $departamento = $this->toObject($linha);

            array_push($listaDeDepartamentos, $departamento);
        }
        return $listaDeDepartamentos;
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
        $departamentos = $this->buscar(null, null);

        $options = [];

        if (isset($departamentos)) {

            foreach ($departamentos as $key => $value) {
                $options += [$value->id => $value->nome . ' (' . $value->sigla . ')'];
            }
        }
        return $options;
    }

    public function listarProcessos() {

        $usuario = $this->UsuarioDAO->retriveUsuarioAtual();
        $listaDeUsuarios = $this->UsuarioDAO->retriveUsuariosPeloDepartamentoId($usuario->departamento->id);

        return $listaDeUsuarios;
    }

    public function listarUsuarios() {

        $usuario = $this->UsuarioDAO->retriveUsuarioAtual();

        $listaDeProcessos = $this->ProcessoDAO->retriveDepartamentoId($usuario->departamento->id);

        return $listaDeProcessos;
    }

    public function toArray($objeto) {
        return array(
            'id' => $objeto->id,
            'nome' => $objeto->nome,
            'sigla' => $objeto->sigla,
            'ug_id' => $objeto->ug->id,
            'status' => $objeto->status
        );
    }

    public function toObject($arrayList) {
        return new Departamento(
                $arrayList->id,
                $arrayList->nome,
                $arrayList->sigla,
                $this->UgDAO->buscarPorId($arrayList->ug_id),
                $arrayList->status
        );
    }

}
