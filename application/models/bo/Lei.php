<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Lei implements Utilidades{

    private $id;
    private $numero;
    private $artigo;
    private $inciso;
    private $data;
    private $modalidade;
    private $status;

    public function __construct(
            $id,
            $numero,
            $artigo,
            $inciso,
            $data,
            $modalidade,
            $status = true
    ) {
        $this->id = $id;
        $this->numero = $numero;
        $this->artigo = $artigo;
        $this->inciso = $inciso;
        $this->data = $data;
        $this->modalidade = $modalidade;
        $this->status = $status;
    }

    function __get($key) {
        return $this->$key;
    }

    function __set($key, $value) {
        $this->$key = $value;
    }

    public function toString() {


        $art = ($this->artigo != "") ? (", Art. " . $this->artigo) : '';
        $inc = ($this->inciso != "") ? (", Inc. " . $this->inciso) : '';
        $dat = ", de " . (new DateTime($this->data))->format('d-m-Y');//todo data

        return $this->numero . $art . $inc . $dat;
    }

}
