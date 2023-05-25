<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('application/models/bo/Hierarquia.php');

class HierarquiaDAO extends CI_Model
{

    public static $TABELA_DB = 'hierarquia';

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

    public function buscarPorId($hierarquiaId)
    {
        $array = $this->DAO->buscarPorId(self::$TABELA_DB, $hierarquiaId);

        return $this->toObject($array->result()[0]);
    }

    public function buscarOnde($key, $value)
    {
        $array = $this->DAO->buscarOnde(self::$TABELA_DB, array($key => $value));

        return $this->criarLista($array->result());
    }

    public function atualizar($hierarquia)
    {
        $this->DAO->atualizar(self::$TABELA_DB, $hierarquia->toArray());
    }


    public function deletar($hierarquia)
    {
        $this->DAO->deletar(self::$TABELA_DB, $hierarquia->toArray());
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
        return new Hierarquia(
            isset($arrayList->id)
            ? $arrayList->id
            : (isset($arrayList['id']) ? $arrayList['id'] : null),
            isset($arrayList->posto_ou_graduacao)
            ? $arrayList->posto_ou_graduacao
            : (isset($arrayList['posto_ou_graduacao']) ? $arrayList['posto_ou_graduacao'] : null),
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
        $listaDeHierarquia = array();

        foreach ($array->result() as $linha) {

            $hierarquia = $this->toObject($linha);

            array_push($listaDeHierarquia, $hierarquia);
        }

        return $listaDeHierarquia;
    }

    public function options()
    {
        $hierarquias = $this->buscarTodos(null, null);

        $options = [];

        if (isset($hierarquias)) {

            foreach ($hierarquias as $hierarquia) {

                $options += [$hierarquia->id => $hierarquia->postoOuGraduacao];
            }
        }
        return $options;
    }

}