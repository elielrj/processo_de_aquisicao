<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Artefato
{
    private $id;
    private $nome;


    public function __construct(
        $id,
        $nome
    ) {
        $this->id = $id;
        $this->nome = $nome;
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