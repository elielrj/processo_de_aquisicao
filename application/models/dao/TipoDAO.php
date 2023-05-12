<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('application/models/bo/Tipo.php');

class TipoDAO extends CI_Model
{

    public static $TABELA_DB = 'tipo';

    public function __construct()
    {
        $this->load->model('dao/DAO');
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

    public function buscarPorId($tipoId)
    {
        $array = $this->DAO->buscarPorId(self::$TABELA_DB, $tipoId);

        return $this->toObject($array->result()[0]);
    }

    public function buscarOnde($key, $value)
    {
        $array = $this->DAO->buscarOnde(self::$TABELA_DB, array($key => $value));

        return $this->criarLista($array->result());
    }

    public function atualizar($tipo)
    {
        $this->DAO->atualizar(self::$TABELA_DB, $tipo->toArray());
    }


    public function deletar($tipo)
    {
        $this->DAO->deletar(self::$TABELA_DB, $tipo->toArray());
    }

    public function contar()
    {
        return $this->DAO->contar(self::$TABELA_DB);
    }

    public function contarDesativados()
    {
        return $this->DAO->contarDesativados(self::$TABELA_DB);
    }

    private function toObject($arrayList)
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