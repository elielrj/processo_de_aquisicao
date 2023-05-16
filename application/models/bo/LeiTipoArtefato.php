<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('InterfaceBO.php');

class LeiTipoArtefato implements InterfaceBO {

    private $lei;
    private $tipo;
    private $artefato;
    private $status;

    /**
     * O Arquivo não é construindo juntamente com o Artefato, 
     * somente é acrescentado a este Objeto quando o Objeto Processo for criado 
     * com a lista de Artefatos
     */
    public function __construct(
            $lei,
            $tipo,
            $artefato,
            $status
    ) {
        $this->lei = $lei;
        $this->tipo= $tipo;
        $this->artefato = $artefato;
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
            'lei_id' => $this->lei->id,
            'tipo_id' => $this->tipo->id,
            'artefato_id' => $this->artefato->id,
            'status' => $this->status,
        );
    }
}
