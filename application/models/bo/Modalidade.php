<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Modalidade {

    private $id;
    private $nome;
    private $status;

    public function __construct(
            $id,
            $nome,
            $status
    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->status = $status;
    }

    function __get($key) {
        return $this->$key;
    }

    function __set($key, $value) {
        $this->$key = $value;
    }

}
