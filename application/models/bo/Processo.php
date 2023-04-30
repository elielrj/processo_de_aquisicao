<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Processo {

    private $id;
    private $objeto;
    private $nupNud;
    private $dataDoProcesso;
    private $chaveDeAcesso;
    private $departamento;
    private $tipoDeLicitacao;
    private $arquivos;
    private $status;

    public function __construct(
            $id,
            $objeto,
            $nupNud,
            $dataDoProcesso,
            $chaveDeAcesso,
            $departamento,
            $tipoDeLicitacao,
            $status,
            $arquivos = null
    ) {
        $this->id = $id;
        $this->objeto = $objeto;
        $this->nupNud = $nupNud;
        $this->dataDoProcesso = $dataDoProcesso;
        $this->chaveDeAcesso = $chaveDeAcesso;
        $this->departamento = $departamento;
        $this->tipoDeLicitacao = $tipoDeLicitacao;
        $this->status = $status;
        $this->arquivos = $arquivos;
    }

    function __get($key) {
        return $this->$key;
    }

    function __set($key, $value) {
        $this->$key = $value;
    }

}
