<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Artefato {

    private $id;
    private $nome;
    private $arquivo;
    private $status;

    public function __construct(
            $id,
            $nome,
            $arquivo,
            $status = true
    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->arquivo = $arquivo;
        $this->status = $status;
    }

    function __get($key) {
        return $this->$key;
    }

    function __set($key, $value) {
        $this->$key = $value;
    }

    public function buscarArquivoDoArtefato($processoId){
        $this->arquivo = $this->ArquivoDAO->buscarArquivoDoArtefato($processoId,$this->id);
    }
}
