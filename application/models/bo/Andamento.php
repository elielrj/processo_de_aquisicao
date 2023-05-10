<?php

defined('BASEPATH') or exit('No direct script access allowed');


class Andamento implements StatusDoAndamento{

    private $id;
    private $statusDoAndamento;
    private $dataHora;

    public function __construct(
        $id = null,
        $statusDoAndamento = new Enviado(),
        $dataHora = now()){
            $this->id = $id;
            $this->statusDoAndamento = $statusDoAndamento;
            $this->dataHora = $dataHora;       
    }
    
    public function nome(){
        return $this->statusDoAndamento->nome();
    }
    public function nivel(){
        return $this->statusDoAndamento->nivel();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getDataHora()
    {
        return $this->dataHora;
    }

    public function setDataHora($dataHora)
    {
        $this->dataHora = $dataHora;
    }

}


?>