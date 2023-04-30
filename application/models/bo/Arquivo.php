<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Arquivo
{
    private $id;
    private $path;
    private $nomeDoArquivo;
    private $dataDoUpload;
    private $processo;
    private $artefato;
    private $status;


    public function __construct(
        $id,
        $path,
        $nomeDoArquivo,
        $dataDoUpload,
        $processo,
        $artefato,
        $status
    ) {
        $this->id = $id;
        $this->path = $path;
        $this->nomeDoArquivo = $nomeDoArquivo;
        $this->dataDoUpload = $dataDoUpload;
        $this->processo = $processo;
        $this->artefato = $artefato;
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