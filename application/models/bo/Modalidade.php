<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Modalidade {

    private $id;
    private $nome;
    private $lei;
    private $listaDeArtefatos;
    private $status;

    public function __construct(
            $id,
            $nome,
            $lei,
            $listaDeArtefatos,
            $status
    ) {
        $this->id = $id;
        $this->nome = $nome;
        $this->lei = $lei;
        $this->listaDeArtefatos = $listaDeArtefatos;
        $this->status = $status;
    }

    function __get($key) {
        return $this->$key;
    }

    function __set($key, $value) {
        $this->$key = $value;
    }

    public function buscarArquivosDaListaDeArtefatos($processoId){

        foreach($listaDeArtefatos as $artefato){

            $artefato->buscarArquivoDoArtefato($processoId);
        }
    }

}
