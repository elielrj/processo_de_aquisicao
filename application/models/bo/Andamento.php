<?php

defined('BASEPATH') or exit('No direct script access allowed');


class Andamento implements StatusDoAndamento, Utilidades
{

    private $id;
    private $statusDoAndamento;
    private $dataHora;

    public function __construct(
        $id = null,
        $statusDoAndamento = null,
        $dataHora = null
    ) {
        $this->id = isset($id) ? $id : null;
        $this->statusDoAndamento = isset($statusDoAndamento) ? $statusDoAndamento : new Enviado();
        $this->dataHora = isset($dataHora) ? $dataHora : now('America/Sao_Paulo');
    }

    public function nome()
    {
        return $this->statusDoAndamento->nome();
    }
    public function nivel()
    {
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

    public function transformarObjetoEmArray()
    {
        return array(
            'id' => $this->id,
            'statusDoAndamento' => $this->statusDoAndamento->nome(),
            'dataHora' => $this->dataHora,
        );
    }

    public static function transformarArrayEmObjeto($arrayList)
    {
        return new Andamento(
            isset($arrayList->id) ? $arrayList->id : (isset($arrayList['id']) ? $arrayList['id'] : null),
            isset($arrayList->statusDoAndamento) ? (Andamento::selecionarStatus($arrayList->statusDoAndamento)) : (isset($arrayList['statusDoAndamento']) ? Andamento::selecionarStatus($arrayList['statusDoAndamento']) : null),
            isset($arrayList->dataHora) ? $arrayList->dataHora : (isset($arrayList['dataHora']) ? $arrayList['dataHora'] : null)
        );
    }

    public static function selecionarStatus($statusDoAndamento)
    {
        if ($statusDoAndamento == Enviado::$NOME) {
            return new Enviado();
        } else if ($statusDoAndamento == Executado::$NOME) {
            return new Executado();
        } else if ($statusDoAndamento == Conformado::$NOME) {
            return new Conformado();
        }
    }

}


?>