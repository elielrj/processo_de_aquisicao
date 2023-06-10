<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('InterfaceBO.php');

class Login implements InterfaceBO
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

    public function array(): array
	{
        return array(
            'email' => $this->email,
            'senha' => md5($this->senha),
        );
    }
}
