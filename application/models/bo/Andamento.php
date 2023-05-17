<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('InterfaceBO.php');
include_once('StatusDoAndamento.php');
include_once('Enviado.php');
include_once('Executado.php');
include_once('Conformado.php');

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
        $this->id = $id;
        $this->statusDoAndamento = isset($statusDoAndamento) ? $statusDoAndamento : new Enviado();
        $this->dataHora = isset($dataHora) ? $dataHora : new DateTime('now',new DateTimeZone('America/Sao_Paulo'));
    }

       function __get($key) {
        return $this->$key;
    }

    function __set($key, $value) {
        $this->$key = $value;
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
        if ($nome == Enviado::NOME) {
            return new Enviado();
        } else if ($nome == Executado::NOME) {
            return new Executado();
        } else if ($nome == Conformado::NOME) {
            return new Conformado();
        }
    }

    public function nome()
    {
        return $this->statusDoAndamento->nome();
    }

    public function nivel()
    {
        return $this->statusDoAndamento->nivel();
    }
}
?>