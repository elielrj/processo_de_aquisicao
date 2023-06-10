<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('InterfaceBO.php');

class Sugestao implements InterfaceBO{

    private $id;
    private $mensagem;
    private $visualizado;

    public function __construct(
            $id,
            $mensagem,
            $visualizado
    ) {
        $this->id = $id;
        $this->mensagem = $mensagem;
        $this->visualizado = $visualizado;
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
            'id' => $this->id,
           'mensagem' =>  $this->mensagem,
           'visualizado' =>  $this->visualizado
        );
    }
}