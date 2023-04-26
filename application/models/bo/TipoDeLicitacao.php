<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TipoDeLicitacao
{
    private $id;
    private $nome;
    private $lei;
    private $dataDaLei;
    private $status;


    public function __construct(
        $id,
        $nome,
        $lei,
        $dataDaLei,
        $status
    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->lei = $lei;
        $this->dataDaLei = $dataDaLei;
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