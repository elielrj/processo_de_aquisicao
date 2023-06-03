<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('InterfaceBO.php');
include_once('application/libraries/DataLibrary.php');

class Arquivo implements InterfaceBO{

    private $id;
    private $path;
    private $dataHora;
    private $usuarioId;
    private $artefatoId;
    private $processoId;
    private $nome;
    private $status;

    public function __construct(
            $id = null,
            $path,
            $dataHora = null,
            $usuarioId,
            $artefatoId,
            $processoId,
            $nome,
            $status = true
    ) {
        $this->id = isset($id) ? $id : null;
        $this->path = $path;
        $this->dataHora = isset($dataHora) ? $dataHora : DataLibrary::dataHoraBr();
        $this->usuarioId = $usuarioId;
        $this->artefatoId = $artefatoId;
        $this->processoId = $processoId;
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
            'id' => isset($this->id) ? $this->id : null,
            'path' => $this->path,
            'data_hora' => DataLibrary::dataHoraMySQL($this->dataHora),
            'usuario_id' => $this->usuarioId,
            'artefato_id' => $this->artefatoId,
            'processo_id' => $this->processoId,
            'nome' => isset($this->nome) ? $this->nome : null,
            'status' => $this->status,
        );
    }
}
