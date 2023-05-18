<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('InterfaceBO.php');

class Artefato implements InterfaceBO {

    private $id;
    private $ordem;
    private $nome;
    private $arquivo;
    private $status;

    /**
     * O Arquivo não é construindo juntamente com o Artefato, 
     * somente é acrescentado a este Objeto quando o Objeto Processo for criado 
     * com a lista de Artefatos
     */
    public function __construct(
            $id = null,
            $ordem,
            $nome,
            $status = true
    ) {
        $this->id = $id;
        $this->ordem = $ordem;
        $this->nome = $nome;
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
            'ordem' => $this->ordem,
            'nome' => $this->nome,
            'status' => $this->status,
        );
    }
}
