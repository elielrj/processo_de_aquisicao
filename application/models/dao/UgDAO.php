<?php

defined('BASEPATH') or exit('No direct script access allowed');

class UgDAO extends CI_Model implements InterfaceCrudDAO
{

    private final $TABELA_DB = 'ug';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('DAO');
    }

    public function criar($objeto)
    {
        $this->DAO->criar($this->TABELA_DB, $objeto->toArray());
    }

    public function buscarTodos($inicial, $final)
    {
        $array = $this->DAO->buscarTodos($this->TABELA_DB, $inicial, $final);

        return $this->criarLista($array);
    }

    public function buscarTodosDesativados($inicial, $final)
    {
        $array = $this->DAO->buscarTodos($this->TABELA_DB, $inicial, $final);

        return $this->criarLista($array);
    }

    public function buscarPorId($ugId)
    {
        $array = $this->db->get_where($this->TABELA_DB, array('id' => $ugId));

        return $this->toObject($array->result());
    }

    public function buscarOnde($key, $value)
    {
        $array = $this->DAO->buscarOnde($this->TABELA_DB, array($key => $value));

        return $this->criarLista($array->result());
    }

    public function atualizar($ug)
    {
        $this->DAO->atualizar($this->TABELA_DB, $ug->toArray());
    }


    public function deletar($ug)
    {
        $this->DAO->deletar($this->TABELA_DB, $ug->toArray());
    }

    public function contar()
    {
        return $this->DAO->contar($this->TABELA_DB);
    }

    public function contarDesativados()
    {
        return $this->DAO->contarDesativados($this->TABELA_DB);
    }

    public function toObject($arrayList)
    {
        return new Ug(
            isset($arrayList->id)
            ? $arrayList->id
            : (isset($arrayList['id']) ? $arrayList['id'] : null),
            isset($arrayList->nome)
            ? $arrayList->nome
            : (isset($arrayList['nome']) ? $arrayList['nome'] : null),
            isset($arrayList->sigla)
            ? $arrayList->sigla
            : (isset($arrayList['sigla']) ? $arrayList['sigla'] : null),
            isset($arrayList->status)
            ? $arrayList->status
            : (isset($arrayList['status']) ? $arrayList['status'] : null)
        );
    }

    private function criarLista($array)
    {
        $listaDeUg = array();

        foreach ($array->result() as $linha) {

            $usuario = $this->toObject($linha);

            array_push($listaDeUg, $usuario);
        }

        return $listaDeUg;
    }

    public function options()
    {

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