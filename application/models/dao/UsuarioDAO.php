<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('application/models/bo/Usuario.php');

class UsuarioDAO extends CI_Model
{

    public static $TABELA_DB = 'usuario';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('dao/DAO');
        $this->load->model('dao/DepartamentoDAO');
    }

    public function criar($usuario)
    {
        $this->DAO->criar(self::$TABELA_DB, $usuario->toArray());
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

    public function buscarPorId($usuarioId)
    {
        $array = $this->DAO->buscarPorId(self::$TABELA_DB, $usuarioId);

        return $this->toObject($array->result()[0]);
    }

    public function buscarOnde($key, $value)
    {
        $array = $this->DAO->buscarOnde(self::$TABELA_DB, array($key => $value));

        return $this->criarLista($array->result());
    }

    public function atualizar($usuario)
    {
        $this->DAO->atualizar(self::$TABELA_DB, $usuario->toArray());
    }


    public function deletar($usuario)
    {
        $this->DAO->deletar(self::$TABELA_DB, $usuario->toArray());
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
        return new Usuario(
            isset($arrayList->id)
            ? $arrayList->id
            : (isset($arrayList['id']) ? $arrayList['id'] : null),
            isset($arrayList->nome)
            ? $arrayList->nome
            : (isset($arrayList['nome']) ? $arrayList['nome'] : null),
            isset($arrayList->sobrenome)
            ? $arrayList->sobrenome
            : (isset($arrayList['sobrenome']) ? $arrayList['sobrenome'] : null),
            isset($arrayList->email)
            ? $arrayList->email
            : (isset($arrayList['email']) ? $arrayList['email'] : null),
            isset($arrayList->cpf)
            ? $arrayList->cpf
            : (isset($arrayList['cpf']) ? $arrayList['cpf'] : null),
            isset($arrayList->senha)
            ? $arrayList->senha
            : (isset($arrayList['senha']) ? $arrayList['senha'] : null),
            isset($arrayList->departamento_id)
            ? ($this->DepartamentoDAO->buscarPorId($arrayList->departamento_id))
            : (isset($arrayList['departamento_id']) ? $this->DepartamentoDAO->buscarPorId($arrayList['departamento_id']) : null),
            isset($arrayList->status)
            ? $arrayList->status
            : (isset($arrayList['status']) ? $arrayList['status'] : null),
            isset($arrayList->hierarquia_id)
            ? $arrayList->hierarquia_id
            : (isset($arrayList['hierarquia_id']) ? $arrayList['hierarquia_id'] : null),//todo
            isset($arrayList->funcao_id)
            ? $arrayList->funcao_id
            : (isset($arrayList['funcao_id']) ? $arrayList['funcao_id'] : null)//todo
        );
    }

    private function criarLista($array)
    {
        $listaDeUsuarios = array();

        foreach ($array->result() as $linha) {

            $usuario = $this->toObject($linha);

            array_push($listaDeUsuarios, $usuario);
        }

        return $listaDeUsuarios;
    }

}