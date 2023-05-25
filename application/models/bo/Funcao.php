<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('InterfaceBO.php');
include_once('NivelDeAcesso.php');

class Funcao implements InterfaceBO, NivelDeAcesso{

    private $id;
    private $nome;
    private $nivelDeAcesso;
    private $status;

    public function __construct(
            $id,
            $nome,
            $nivelDeAcesso,
            $status = true
    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->nivelDeAcesso = $nivelDeAcesso;
        $this->status = $status;
    }

    function __get($key) {
        return $this->$key;
    }

    function __set($key, $value) {
        $this->$key = $value;
    }

    public function toArray()
    {
        return array(
            'id' => $this->id,
            'nome' =>  $this->nome,
            'nivel_de_acesso' =>  $this->nivelDeAcesso->nome(),
            'status' => $this->status
        );
    }

    public function nome()
    {
        return $this->nivelDeAcesso->nome();
    }

    public function nivel()
    {
        return $this->nivelDeAcesso->nivel();
    }

    public static function selecionarNivelDeAcesso($nome)
    {
        if ($nome == Ler::NOME) {
            return new Ler();
        } else if ($nome == Escrever::NOME) {
            return new Escrever();
        } else if ($nome == Administrar::NOME) {
            return new Administrar();
        }else if ($nome == Aprovar::NOME) {
            return new Aprovar();
        }else if ($nome == Root::NOME) {
            return new Root();
        }
    }
}
