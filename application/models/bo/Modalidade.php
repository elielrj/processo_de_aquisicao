<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Modalidade implements InterfaceBO{

    private $id;
    private $nome;
    private $status;

    public function __construct(
            $id = null,
            $nome,
            $status = true
    ) {
        $this->id = isset($id) ? $id : null;
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
            'id' => $this->id,
            'nome' => $this->nome,
            'status' => $this->status,
        );
    }

    public static function transformarArrayEmObjeto($arrayList)
    {
        return new Modalidade(
            isset($arrayList->id) ? $arrayList->id : (isset($arrayList['id']) ? $arrayList['id'] : null),
            isset($arrayList->nome) ? $arrayList->nome : (isset($arrayList['nome']) ? $arrayList['nome'] : null),
            isset($arrayList->status) ? $arrayList->status : (isset($arrayList['status']) ? $arrayList['status'] : null)
        );
    }

}
