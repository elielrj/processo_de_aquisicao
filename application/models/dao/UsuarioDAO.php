<?php

defined('BASEPATH') or exit('No direct script access allowed');

class UsuarioDAO extends DAO
{

    private final $TABELA_DB = 'usuario';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('DAO');
    }

    public function criar($usuario)
    {
        $this->DAO->criar($this->TABELA_DB, $usuario->toArray());
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

    public function buscarPorId($usuarioId)
    {
        $array = $this->db->get_where($this->TABELA_DB, array('id' => $usuarioId));

        return $this->toObject($array->result());
    }

    public function buscarOnde($key, $value)
    {
        $array = $this->DAO->buscarOnde($this->TABELA_DB, array($key => $value));

        return $this->criarLista($array->result());
    }

    public function atualizar($usuario)
    {
        $this->DAO->atualizar($this->TABELA_DB, $usuario->toArray());
    }


    public function deletar($usuario)
    {
        $this->DAO->deletar($this->TABELA_DB, $usuario->toArray());
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
            isset($arrayList->departamento)
            ? $this->buscarDepartamento($arrayList->departamento)
            : (isset($arrayList['departamento']) ? $this->buscarDepartamento($arrayList['departamento']) : null),
            isset($arrayList->status)
            ? $arrayList->status
            : (isset($arrayList['status']) ? $arrayList['status'] : null)
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

    private function buscarDepartamento($departamentoId)
    {
        return $this->DepartamentoDAO->buscarPorId($departamentoId);
    }
}