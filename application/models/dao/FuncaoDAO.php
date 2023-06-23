<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('application/models/bo/Funcao.php');
include_once('application/models/bo/Leitor.php');
include_once('application/models/bo/Escritor.php');
include_once('application/models/bo/Administrador.php');
include_once('application/models/bo/Aprovador.php');
include_once('application/models/bo/Root.php');

class FuncaoDAO extends CI_Model
{

    public static $TABELA_DB = 'funcao';

    public function __construct()
    {
        $this->load->model('dao/DAO');
    }

    public function criar($objeto)
    {
        $this->DAO->criar(self::$TABELA_DB, $objeto->array());
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

    public function buscarPorId($funcaoId)
    {
        $array = $this->DAO->buscarPorId(self::$TABELA_DB, $funcaoId);

        return $this->toObject($array->result()[0]);
    }

    public function buscarOnde($key, $value)
    {
        $array = $this->DAO->buscarOnde(self::$TABELA_DB, array($key => $value));

        return $this->criarLista($array->result());
    }

    public function atualizar($funcao)
    {
        $this->DAO->atualizar(self::$TABELA_DB, $funcao->array());
    }


    public function deletar($funcao)
    {
        $this->DAO->deletar(self::$TABELA_DB, $funcao->array());
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
        return new Funcao(
            isset($arrayList->id)
            ? $arrayList->id
            : (isset($arrayList['id']) ? $arrayList['id'] : null),
            isset($arrayList->nome)
            ? $arrayList->nome
            : (isset($arrayList['nome']) ? $arrayList['nome'] : null),
            isset($arrayList->nivel_de_acesso)
            ? Funcao::selecionarNivelDeAcesso($arrayList->nivel_de_acesso)
            : (isset($arrayList['nivel_de_acesso']) ? Funcao::selecionarNivelDeAcesso($arrayList['nivel_de_acesso']) : null),
            isset($arrayList->status)
            ? $arrayList->status
            : (isset($arrayList['status']) ? $arrayList['status'] : null)
        );
    }

    private function criarLista($array)
    {
        $listaDefuncao = array();

        foreach ($array->result() as $linha) {

            $funcao = $this->toObject($linha);

            array_push($listaDefuncao, $funcao);
        }

        return $listaDefuncao;
    }

    public function options()
    {
        $funcoes = $this->buscarTodos(null, null);

        $options = [];

        if (isset($funcoes)) {

            foreach ($funcoes as $funcao) {

                $options += [$funcao->id => $funcao->nome];

            }
        }
        return $options;
    }

}
