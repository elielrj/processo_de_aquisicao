<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Loginimplements Utilidades
{

    private $email;
    private $senha;

    public function __construct(
        $email,
        $senha
    ) {
        $this->email = $email;
        $this->senha = $senha;
    }

    function __get($key)
    {
        return $this->$key;
    }

    function __set($key, $value)
    {
        $this->$key = $value;
    }
}
