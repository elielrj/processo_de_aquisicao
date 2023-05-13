<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('InterfaceBO.php');
include_once('StatusDoAndamento.php');
class Andamento implements StatusDoAndamento, InterfaceBO
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
        $this->dataHora = isset($dataHora) ? $dataHora : new DateTime('now',new DateTimeZone('America/Sao_Paulo'));
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

    public function nome()
    {
        return $this->statusDoAndamento->nome();
    }
    public function nivel()
    {
        return $this->statusDoAndamento->nivel();
    }

    public function toArray()
    {
        $this->load->helper('data');

        return array(
            'id' => $this->id,
            'status_do_andamento' => $this->statusDoAndamento->nome(),
            'data_hora' => $this->data->dataHoraMySQL($this->dataHora),
        );
    }

    public static function selecionarStatus($nome)
    {
        if ($nome == Enviado::$NOME) {
            return new Enviado();
        } else if ($nome == Executado::$NOME) {
            return new Executado();
        } else if ($nome == Conformado::$NOME) {
            return new Conformado();
        }
    }
}
?>