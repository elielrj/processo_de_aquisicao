<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('application/models/bo/Departamento.php');

class DepartamentoDAO extends CI_Model
{

    public static $TABELA_DB = 'departamento';

    public function __construct()
    {
        $this->load->model('dao/DAO');
        $this->load->model('dao/UgDAO');
    }

    public function criar($objeto)
    {
        $this->DAO->criar(self::$TABELA_DB, $objeto->toArray());
    }

    public function buscarTodos($inicial, $final)
    {
        $array = $this->DAO->buscarTodos(self::$TABELA_DB, $inicial, $final);

        return $this->criarLista($array);
    }

    public function buscarTodosDesativados($inicial, $final)
    {
        $array = $this->DAO->buscarTodosDesativados(self::$TABELA_DB, $inicial, $final);

        return $this->criarLista($array);
    }

    public function buscarPorId($departamentoId)
    {
        $array = $this->DAO->buscarPorId(self::$TABELA_DB, $departamentoId);

        return $this->toObject($array->result()[0]);
    }

    public function buscarOnde($key, $value)
    {
        $array = $this->DAO->buscarOnde(self::$TABELA_DB, array($key => $value));

        return $this->criarLista($array->result());
    }

    public function atualizar($departamento)
    {
        $this->DAO->atualizar(self::$TABELA_DB, $departamento->toArray());
    }


    public function deletar($departamento)
    {
        $this->DAO->deletar(self::$TABELA_DB, $departamento->toArray());
    }

    public function contar()
    {
        return $this->DAO->contar(self::$TABELA_DB);
    }

    public function contarDesativados()
    {
        return $this->DAO->contarDesativados(self::$TABELA_DB);
    }

    public function toObject($arrayList)
    {
        return new Departamento(
            isset($arrayList->id)
            ? $arrayList->id
            : (isset($arrayList['id']) ? $arrayList['id'] : null),
            isset($arrayList->nome)
            ? $arrayList->nome
            : (isset($arrayList['nome']) ? $arrayList['nome'] : null),
            isset($arrayList->sigla)
            ? $arrayList->sigla
            : (isset($arrayList['sigla']) ? $arrayList['sigla'] : null),
            isset($arrayList->ug_id)
            ? $this->UgDAO->buscarPorId($arrayList->ug_id)
            : (isset($arrayList['ug_id']) ? $this->UgDAO->buscarPorId($arrayList['ug_id']) : null),
            isset($arrayList->status)
            ? $arrayList->status
            : (isset($arrayList['status']) ? $arrayList['status'] : null)
        );
    }

    private function criarLista($array)
    {
        $listaDeDepartamento = array();

        foreach ($array->result() as $linha) {

            $departamento = $this->toObject($linha);

            array_push($listaDeDepartamento, $departamento);
        }

        return $listaDeDepartamento;
    }

    public function options()
    {
        $departamentos = $this->buscarTodos(null, null);

        $options = [];

        if (isset($departamentos)) {

            foreach ($departamentos as $departamento) {
                $options += [$departamento->id => $departamento->toString()];
            }
        }
        return $options;
    }

}