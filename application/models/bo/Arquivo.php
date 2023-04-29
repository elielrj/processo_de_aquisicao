<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Arquivo
{
    private $id;
    private $artefato;
    private $path;
    private $nomeDoArquivo;
    private $dataDoUpload;
    private $processo;
    private $status;


    public function __construct(
        $id,
        $artefato,
        $path,
        $nomeDoArquivo,
        $dataDoUpload,
        $processo,
        $status
    ) {
        $this->id = $id;
        $this->artefato = $artefato;
        $this->path = $path;
        $this->nomeDoArquivo = $nomeDoArquivo;
        $this->dataDoUpload = $dataDoUpload;
        $this->processo = $processo;
        $this->status = $status;
    }

    function __get($key)
    {
        return $this->$key;
    }

    function __set($key, $value)
    {
        $this->$key = $value;
    }
}