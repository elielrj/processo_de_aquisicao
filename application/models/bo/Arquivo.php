<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('InterfaceBO.php');

class Arquivo implements InterfaceBO{

    private $id;
    private $path;
    private $dataHora;
    private $usuarioId;
    private $artefatoId;
    private $processoId;
    private $status;

    public function __construct(
            $id = null,
            $path,
            $dataHora = null,
            $usuarioId,
            $artefatoId,
            $processoId,
            $status = true
    ) {
        $this->id = isset($id) ? $id : null;
        $this->path = $path;
        $this->dataHora = isset($dataHora) ? $dataHora : now('America/Sao_Paulo');
        $this->usuarioId = $usuarioId;
        $this->artefatoId = $artefatoId;
        $this->processoId = $processoId;
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
        $this->load->helper('data');

        return array(
            'id' => isset($this->id) ? $this->id : null,
            'path' => $this->path,
            'data_hora' => $this->data->dataHoraMySQL($this->dataHora),
            'usuario_id' => $this->usuarioId,
            'artefato_id' => $this->artefatoId,
            'processo_id' => $this->processoId,
            'status' => $this->status,
        );
    }
}
