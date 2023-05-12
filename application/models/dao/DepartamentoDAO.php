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

        $resultado = $this->db
        ->where(array('status' => true))
                ->order_by('nome')
                ->get(
                self::$TABELA_DB,
                $quantidadeMostrar,
                $indiceInicial
        );

        $listaDeDepartamentos = array();

        foreach ($resultado->result() as $linha) {

            $departamento = $this->transformarArrayEmObjeto($linha);

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

            return $this->transformarArrayEmObjeto($linha);
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
        return $this->db
        ->where(array('status' => true))
        ->count_all_results(self::$TABELA_DB);
    }

    public function options() {
        $departamentos = $this->buscar(null, null);

        $options = [];

        if (isset($departamentos)) {

            foreach ($departamentos as $key => $departamento) {
                $options += [$departamento->id => $departamento->toString()];
            }
        }
        return $options;
    }

    public function listarProcessos() {

        $usuario = $this->UsuarioDAO->buscarUsuarioAtual();
        $listaDeUsuarios = $this->UsuarioDAO->buscarUsuariosPeloDepartamentoId($usuario->departamento->id);

        return $listaDeUsuarios;
    }

    public function listarUsuarios() {

        $usuario = $this->UsuarioDAO->buscarUsuarioAtual();

        $listaDeProcessos = $this->ProcessoDAO->buscarDepartamentoId($usuario->departamento->id);

        return $listaDeProcessos;
    }

    public function transformarArrayEmObjeto($arrayList) {
        return new Departamento(
                $arrayList->id,
                $arrayList->nome,
                $arrayList->sigla,
                $this->UgDAO->buscarPorId($arrayList->ug_id),
                $arrayList->status
        );
    }

}
