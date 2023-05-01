<?php

defined('BASEPATH') or exit('No direct script access allowed');

include('application/models/bo/Usuario.php');
include('InterfaceCrudDAO.php');

class UsuarioDAO extends CI_Model implements InterfaceCrudDAO {

    public static $TABELA_DB = 'usuario';

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

        $listaDeUsuarios = array();

        foreach ($resultado->result() as $linha) {

            $usuario = $this->toObject($linha);

            array_push($listaDeUsuarios, $usuario);
        }

        return $listaDeUsuarios;
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

    public function buscarUsuariosPeloDepartamentoId($departamento_id) {

        $resultado = $this->db->get_where(
                self::$TABELA_DB,
                array('departamento_id' => $departamento_id)
        );

        foreach ($resultado->result() as $linha) {
            return new $this->toObject($linha);
        }
    }

    public function buscarUsuarioAtual() {
        return $this->retriveId($this->session->id);
    }

    public function atualizar($usuario) {

        $this->db->update(
                self::$TABELA_DB,
                $this->toArray($usuario),
                array('id' => $usuario->id)
        );
    }

    public function desativar($usuarioId) {
        return $this->db->delete(
                        self::$TABELA_DB,
                        array('id' => $usuarioId),
                        array('status' => false)
        );
    }

    public function ativar($usuarioId) {
        return $this->db->delete(
                        self::$TABELA_DB,
                        array('id' => $usuarioId),
                        array('status' => true)
        );
    }

    public function quantidade() {
        return $this->db->count_all_results(self::$TABELA_DB);
    }

    public function verificarEmail($where) {
        $resultado = $this->db->get_where('usuario', $where);
        return $resultado->result();
    }

    public function verificarSenha($where) {
        $resultado = $this->db->get_where('usuario', $where);
        return $resultado->result();
    }

    public function buscarPeloEmail($email) {
        $resultado = $this->db->get_where(
                self::$TABELA_DB,
                array('email' => $email)
        );

        foreach ($resultado->result() as $linha) {
            return $this->toObject($linha);
        }
    }

    public function toArray($objeto) {
        return array(
            'id' => $objeto->id,
            'email' => $objeto->email,
            'cpf' => $objeto->cpf,
            'senha' => $objeto->senha,
            'departamento_id' => $objeto->departamento->id,
            'status' => $objeto->status,
        );
    }

    public function toObject($arrayList) {
        return new Usuario(
                $arrayList->id,
                $arrayList->email,
                $arrayList->cpf,
                $arrayList->senha,
                $arrayList->departamento,
                $arrayList->status
        );
    }

}
