<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Arquivo implements Utilidades{

    private $id;
    private $path;
    private $dataHora;
    private $status;

    public function __construct(
            $id = null,
            $path,
            $dataHora = null,
            $status = true
    ) {
        $this->id = isset($id) ? $id : null;
        $this->path = $path;
        $this->dataHora = isset($dataHora) ? $dataHora : now('America/Sao_Paulo');
        $this->status = $status;
    }

    function __get($key) {
        return $this->$key;
    }

    function __set($key, $value) {
        $this->$key = $value;
    }

    public function transformarObjetoEmArray()
    {
        return array(
            'id' => $this->id,
            'path' => $this->path,
            'dataHora' => $this->dataHora,
            'status' => $this->status,
        );
    }

    public static function transformarArrayEmObjeto($arrayList)
    {
        return new Andamento(
            isset($arrayList->id) ? $arrayList->id : (isset($arrayList['id']) ? $arrayList['id'] : null),
            isset($arrayList->path) ? $arrayList->path : (isset($arrayList['path']) ? $arrayList['path'] : null),
            isset($arrayList->dataHora) ? $arrayList->dataHora : (isset($arrayList['dataHora']) ? $arrayList['dataHora'] : null),
            isset($arrayList->status) ? $arrayList->status : (isset($arrayList['status']) ? $arrayList['status'] : null)
        );
    }

}
