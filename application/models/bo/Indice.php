<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Indice
{
    private $id;
    private $tipoDeLicitacao;
    private $status;


    public function __construct(
        $id,
        $tipoDeLicitacao,
        $status
    ) {
        $this->id = $id;
        $this->tipoDeLicitacao = $tipoDeLicitacao;
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
}