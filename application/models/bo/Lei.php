<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Lei {

    private $id;
    private $numero;
    private $artigo;
    private $inciso;
    private $data;
    private $status;

    public function __construct(
            $id,
            $numero,
            $artigo,
            $inciso,
            $data,
            $status = true
    ) {
        $this->id = $id;
        $this->numero = $numero;
        $this->artigo = $artigo;
        $this->inciso = $inciso;
        $this->data = $data;
        $this->status = $status;
    }

    function __get($key) {
        return $this->$key;
    }

    function __set($key, $value) {
        $this->$key = $value;
    }

}
