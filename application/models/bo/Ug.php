<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Ug implements Utilidades{

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
}
