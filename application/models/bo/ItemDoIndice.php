<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ItemDoIndice {

    private $id;
    private $ordem;
    private $status;

    public function __construct(
            $id,
            $ordem,
            $status
    ) {
        $this->id = $id;
        $this->ordem = $ordem;
        $this->status = $status;
    }

    function __get($key) {
        return $this->$key;
    }

    function __set($key, $value) {
        $this->$key = $value;
    }

}
