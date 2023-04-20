<?php

class Usuario
{

    private $id;
    private $email;
    private $cpf;
    private $senha;
    private $status;

    
    public function __construct($id = null,$email = null,$cpf = null,$senha = null,$status = null){
        $this->id = $id;
        $this->email = $email;
        $this->cpf = $cpf;
        $this->senha = $senha;
        $this->status = $status;
    }

    function __get($key){
        return $this->$key;
    }
    
    function __set($key,$value){
        $this->$key = $value;
    }
}