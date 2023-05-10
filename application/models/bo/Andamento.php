<?php

defined('BASEPATH') or exit('No direct script access allowed');


class Andamento implements StatusDoAndamento{

    private $status;
    private $dataHora;

    public function __construct($id,$status,$dataHora){
        $this->id = $id;
        $this->status = $status;
        $this->dataHora = $dataHora;       
    }
    
    public function nome(){
        return $this->status->nome();
    }
    public function nivel(){
        return $this->status->nivel();
    }

    function __get($key)
    {
        return $this->$key;
    }

    function __set($key, $value)
    {
        $this->$key = $value;
    }

}


?>