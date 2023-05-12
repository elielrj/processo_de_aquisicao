<?php

defined('BASEPATH') or exit('No direct script access allowed');

class TipoDAO extends DAO
{

    public static $TABELA_DB = 'tipo';

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

    public function buscarPorId($tipoId)
    {
        $array = $this->db->get_where($this->TABELA_DB, array('id' => $tipoId));

        return $this->toObject($array->result());
    }

    public function buscarOnde($key, $value)
    {
        $array = $this->DAO->buscarOnde($this->TABELA_DB, array($key => $value));

        return $this->criarLista($array->result());
    }

    public function atualizar($tipo)
    {
        $this->DAO->atualizar($this->TABELA_DB, $tipo->toArray());
    }


    public function deletar($tipo)
    {
        $this->DAO->deletar($this->TABELA_DB, $tipo->toArray());
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
        return new Tipo(
            isset($arrayList->id)
            ? $arrayList->id
            : (isset($arrayList['id']) ? $arrayList['id'] : null),
            isset($arrayList->nome)
            ? $arrayList->nome
            : (isset($arrayList['nome']) ? $arrayList['nome'] : null),
            isset($arrayList->status)
            ? $arrayList->status
            : (isset($arrayList['status']) ? $arrayList['status'] : null)
        );
    }

    private function criarLista($array)
    {
        $listaDeTipo = array();

        foreach ($array->result() as $linha) {

            $tipo = $this->toObject($linha);

            array_push($listaDeTipo, $tipo);
        }

        return $listaDeTipo;
    }

    public function options()
    {

        $tipos = $this->buscarTodos(null, null);

        $options = [];

        if (isset($tipos)) {

            foreach ($tipos as $key => $tipo) {

                $options += [$tipo->id => $tipo->nome];
            }
        }

        return $options;
    }

}