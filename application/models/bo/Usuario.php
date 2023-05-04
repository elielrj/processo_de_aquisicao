<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Usuario {

    private $id;
    private $nome;
    private $sobrenome;
    private $email;
    private $cpf;
    private $senha;
    private $departamento;
    private $status;

    public function __construct(
            $id,
            $nome,
            $sobrenome,
            $email,
            $cpf,
            $senha,
            $departamento,
            $status = true
    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->sobrenome = $sobrenome;
        $this->email = $email;
        $this->cpf = $cpf;
        $this->senha = $senha;
        $this->departamento = $departamento;
        $this->status = $status;
    }

    function __get($key) {
        return $this->$key;
    }

    function __set($key, $value) {
        $this->$key = $value;
    }

}
