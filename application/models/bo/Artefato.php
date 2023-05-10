<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Artefato
implements Utilidades {

    private $id;
    private $ordem;
    private $nome;
    private $arquivo;
    private $status;

    public function __construct(
            $id,
            $ordem,
            $nome,
            $arquivo = null,
            $status = true
    ) {
        $this->id = $id;
        $this->ordem = $ordem;
        $this->nome = $nome;
        $this->arquivo = $arquivo;
        $this->status = $status;
    }

    function __get($key) {
        return $this->$key;
    }

    function __set($key, $value) {
        $this->$key = $value;
    }

}
