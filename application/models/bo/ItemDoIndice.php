<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ItemDoIndice {

    private $id;
    private $ordem;
    private $artefato;
    private $status;

    public function __construct(
            $id,
            $ordem,
            $artefato,
            $status
    ) {
        $this->id = $id;
        $this->ordem = $ordem;
        $this->artefato = $artefato;
        $this->status = $status;
    }

    function __get($key) {
        return $this->$key;
    }

    function __set($key, $value) {
        $this->$key = $value;
    }

}
