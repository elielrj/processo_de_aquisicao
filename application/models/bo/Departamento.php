<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Departamento {

    private $id;
    private $nome;
    private $sigla;
    private $status;
    private $processos;

    public function __construct(
            $id,
            $nome,
            $sigla,
            $status,
            $processos = null
    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->sigla = $sigla;
        $this->status = $status;
        $this->processos = $processos;
    }

    function __get($key) {
        return $this->$key;
    }

    function __set($key, $value) {
        $this->$key = $value;
    }

}
