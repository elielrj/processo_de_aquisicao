<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('InterfaceBO.php');

class Arquivo implements InterfaceBO{

    private $id;
    private $path;
    private $dataHora;
    private $status;

    public function __construct(
            $id = null,
            $path,
            $dataHora = null,
            $status = true
    ) {
        $this->id = isset($id) ? $id : null;
        $this->path = $path;
        $this->dataHora = isset($dataHora) ? $dataHora : now('America/Sao_Paulo');
        $this->status = $status;
    }

    function __get($key) {
        return $this->$key;
    }

    function __set($key, $value) {
        $this->$key = $value;
    }

    public function toArray()
    {
        return array(
            'id' => isset($this->id) ? $this->id : null,
            'path' => $this->path,
            'data_hora' => $this->dataHora,
            'status' => $this->status,
        );
    }
}
