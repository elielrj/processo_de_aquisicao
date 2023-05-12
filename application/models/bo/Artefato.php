<?php

defined('BASEPATH') or exit('No direct script access allowed');

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
            'id' => $this->id,
            'ordem' => $this->ordem,
            'nome' => $this->nome,
            'status' => $this->status,
        );
    }

    public static function transformarArrayEmObjeto($arrayList)
    {
        return new Artefato(
            isset($arrayList->id) ? $arrayList->id : (isset($arrayList['id']) ? $arrayList['id'] : null),
            isset($arrayList->nome) ? $arrayList->nome : (isset($arrayList['nome']) ? $arrayList['nome'] : null),
            isset($arrayList->status) ? $arrayList->status : (isset($arrayList['status']) ? $arrayList['status'] : null)
        );
    }

}
