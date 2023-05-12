<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ConsultarDAO extends CI_Model
{

    public static $TABELA_DB = 'processo';

    public function __construct()
    {
        $this->load->model('dao/ProcessoDAO');
        $this->load->model('dao/DAO');
    }

    public function buscarPorNumeroChave($numero, $chave)
    {
        return $this->ProcessoDAO->buscarProcessoPeloNumeroChave($numero, $chave);
    }

    public function numeroExiste($numero)
    {
        $array = $this->DAO->buscarOnde(self::$TABELA_DB, array('numero' => $numero));

        return ($array->num_rows() == 1);
    }

    public function chaveEstaCorreta($chave)
    {
        $array = $this->DAO->buscarOnde(self::$TABELA_DB, array('chave' => $chave));

        return ($array->num_rows() == 1);
    }
}