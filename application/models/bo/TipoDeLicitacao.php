<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TipoDeLicitacao
{
    private $id;
    private $nome;
    private $lei;
    private $artigo;
    private $inciso;
    private $dataDaLei;
    private $pagina;
    private $status;


    public function __construct(
        $id,
        $nome,
        $lei,
        $artigo,
        $inciso,
        $dataDaLei,
        $pagina,
        $status
    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->lei = $lei;
        $this->artigo = $artigo;
        $this->inciso = $inciso;
        $this->dataDaLei = $dataDaLei;
        $this->pagina = $pagina;
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