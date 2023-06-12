<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('InterfaceBO.php');

class Ug implements InterfaceBO{

    private $id;
    private $numero;
    private $nome;
    private $sigla;
    private $status;

    public function __construct(
            $id,
            $numero,
            $nome,
            $sigla,
            $status = true
    ) {
        $this->id = $id;
        $this->numero = $numero;
        $this->nome = $nome;
        $this->sigla = $sigla;
        $this->status = $status;
    }

    function __get($key) {
        return $this->$key;
    }

    function __set($key, $value) {
        $this->$key = $value;
    }

    public function toString() {
        return $this->nome . "(" . $this->sigla . " - " . $this->numero . ")";
    }

    public function array(): array
	{
        return array(
            'id' => $this->id ?? null,
           'numero' =>  $this->numero,
           'nome' =>  $this->nome,
           'sigla' =>  $this->sigla,
           'status' =>  $this->status
        );
    }
}
