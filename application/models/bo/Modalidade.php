<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('InterfaceBO.php');


class Modalidade implements InterfaceBO
{

    private $id;
    private $nome;
    private $status;

    public function __construct(
        $id = null,
        $nome,
        $status = true
    ) {
        $this->id = isset($id) ? $id : null;
        $this->nome = $nome;
        $this->status = $status;
    }

    function __get($key)
    {
        return $this->$key;
    }

    function __set($key, $value)
    {
        $this->$key = $value;
    }

    public function toArray()
    {
        return array(
            'id' => isset($this->id) ? $this->id : null,
            'nome' => $this->nome,
            'status' => $this->status,
        );
    }
}