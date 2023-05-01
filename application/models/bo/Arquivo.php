<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Arquivo {

    private $id;
    private $path;
    private $data;
    private $status;

    public function __construct(
            $id,
            $path,
            $data,
            $status = true
    ) {
        $this->id = $id;
        $this->path = $path;
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
