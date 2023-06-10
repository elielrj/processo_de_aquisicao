<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('InterfaceBO.php');

class Usuario implements InterfaceBO
{

    private $id;
    private $nome;
    private $sobrenome;
    private $email;
    private $cpf;
    private $senha;
    private $departamento;
    private $status;
    private $hierarquia;
    private $funcao;

    public function __construct(
        $id,
        $nome,
        $sobrenome,
        $email,
        $cpf,
        $senha,
        $departamento,
        $status = true,
        $hierarquia,
        $funcao
    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->sobrenome = $sobrenome;
        $this->email = $email;
        $this->cpf = $cpf;
        $this->senha = $senha;
        $this->departamento = $departamento;
        $this->status = $status;
        $this->hierarquia = $hierarquia;
        $this->funcao = $funcao;
    }

    function __get($key)
    {
        return $this->$key;
    }

    function __set($key, $value)
    {
        $this->$key = $value;
    }

    public function array(): array
	{
        return array(
            'id' => isset($this->id) ? $this->id : null,
            'nome' => $this->nome,
            'sobrenome' => $this->sobrenome,
            'email' => $this->email,
            'cpf' => $this->cpf,
            'senha' => $this->senha,
            'departamento_id' => $this->departamento->id,
            'status' => $this->status,
            'hierarquia_id' => $this->hierarquia->id,
            'funcao_id' => $this->funcao->id,
        );
    }

}
