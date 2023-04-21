<?php


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
        $id,
        $objeto,
        $nupNud,
        $dataDoProcesso,
        $chaveDeAcesso,
        $usuario,
        $status
    ) {
        $this->id = $id;
        $this->objeto = $objeto;
        $this->nupNud = $nupNud;
        $this->dataDoProcesso = $dataDoProcesso;
        $this->chaveDeAcesso = $chaveDeAcesso;
        $this->usuario = $usuario;
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