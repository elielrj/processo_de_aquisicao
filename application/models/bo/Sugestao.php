<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('InterfaceBO.php');

class Sugestao implements InterfaceBO{

    private $id;
    private $mensagem;
    private $status;
    private $usuario_id;

    public function __construct(
            $id,
            $mensagem,
            $status,
            $usuario_id
    ) {
        $this->id = $id;
        $this->mensagem = $mensagem;
        $this->status = $status;
        $this->usuario_id = $usuario_id;
    }

    function __get($key) {
        return $this->$key;
    }

    function __set($key, $value) {
        $this->$key = $value;
    }

    public function array(): array
	{
        return array(
            'id' => $this->id ?? null,
           'mensagem' =>  $this->mensagem,
           'status' =>  $this->status,
           'usuario_id' => $this->usuario_id
        );
    }
}
