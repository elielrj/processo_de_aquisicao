<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('InterfaceBO.php');
include_once('StatusDoAndamento.php');
include_once('Enviado.php');
include_once('Executado.php');
include_once('Conformado.php');

class Andamento implements StatusDoAndamento, InterfaceBO
{

    private $processo_id;
    private $statusDoAndamento;
    private $dataHora;

    public function __construct(
        $processo_id = null,
        $statusDoAndamento = null,
        $dataHora = null
    ) {       
        $this->processo_id = $processo_id;
        $this->statusDoAndamento = isset($statusDoAndamento) ? $statusDoAndamento : new Enviado();
        $this->dataHora = isset($dataHora) ? $dataHora : DataLibrary::dataHoraMySQL();
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
            'processo_id' => isset($this->processo_id) ? $this->processo_id : null,
            'status_do_andamento' => $this->statusDoAndamento->nome(),
            'data_hora' => DataLibrary::dataHoraMySQL($this->dataHora),
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