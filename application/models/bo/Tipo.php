<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('InterfaceBO.php');


class Tipo implements InterfaceBO{

    private $id;
    private $nome;
    private $status;
    private $listaDeArtefatos;
    

    public function __construct(
            $id,
            $nome,
            $status = true,
            $listaDeArtefatos = null
    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->status = $status;
        $this->listaDeArtefatos = $listaDeArtefatos;
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
            'id' => $this->id,
            'nome' => $this->nome,
            'status' => $this->status
        );
    }

}
