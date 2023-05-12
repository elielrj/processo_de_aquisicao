<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Processo implements InterfaceBO{

    private $id;
    private $objeto;
    private $numero;
    private $data;
    private $chave;
    private $departamento;
    private $lei;
    private $tipo;
    private $completo;
    private $andamento;
    private $status;

    //todo
    public function __construct(
            $id,
            $objeto,
            $numero,
            $data,
            $chave,
            $departamento,
            $lei,
            $tipo,
            $completo = false,
            $andamento = null,
            $status = true
    ) {
        $this->id = $id;
        $this->objeto = $objeto;
        $this->numero = $numero;
        $this->data = $data;
        $this->chave = $chave;
        $this->departamento = $departamento;
        $this->lei = $lei;
        $this->tipo = $tipo;
        $this->completo = $completo;
        $this->andamento = $andamento;
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
            'objeto' => $this->objeto,
            'numero' => $this->numero,
            'data' => $this->data,
            'chave' => $this->chave,
            'departamento_id' => $this->departamento->id,
            'lei_id' => $this->lei->id,
            'tipo_id' => $this->tipo->id,
            'completo' => $this->completo,
            'status' => $this->status
        );
    }
}
