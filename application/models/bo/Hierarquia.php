<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('InterfaceBO.php');

class Hierarquia implements InterfaceBO{

    private $id;
    private $postoOuGraduacao;
    private $sigla;
    private $status;

    public function __construct(
            $id,
            $postoOuGraduacao,
            $sigla,
            $status = true
    ) {
        $this->id = $id;
        $this->postoOuGraduacao = $postoOuGraduacao;
        $this->sigla = $sigla;
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
            'id' => $this->id,
           'posto_ou_graduacao' =>  $this->postoOuGraduacao,
           'sigla' =>  $this->sigla,
           'status' =>  $this->status
        );
    }
}
