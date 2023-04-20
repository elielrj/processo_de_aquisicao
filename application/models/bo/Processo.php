<?php

include('Usuario.php');

class Processo
{
    private $id;
    private $objeto;
    private $nupNud;
    private $dataDoProcesso;
    private $chaveDeAcesso;
    private $usuario;
    private $status;

    
    public function __construct(
        $id = null,
        $objeto = null,
        $nupNud = null,
        $dataDoProcesso = null,
        $chaveDeAcesso = null, 
        Usuario $usuario = null, 
        $status = null
    ){
        $this->id = $id;
        $this->emaobjetoil = $objeto;
        $this->nupNud = $nupNud;
        $this->dataDoProcesso = $dataDoProcesso;
        $this->chaveDeAcesso = $chaveDeAcesso;
        $this->status = $status;
    }

    function __get($key){
        return $this->$key;
    }
    
    function __set($key,$value){
        $this->$key = $value;
    }
}