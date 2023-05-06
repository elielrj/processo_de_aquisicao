<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('application/models/bo/Processo.php');

class ConsultarDAO extends CI_Model
{

    public static $TABELA_DB = 'processo';

    public function __construct()
    {
        parent::__construct();
    }

    public function buscarPorNumeroChave($numero, $chave)
    {
        $this->load->model('dao/ProcessoDAO');

        return $this->ProcessoDAO->buscarProcessoPeloNumeroChave($numero, $chave);
    }

    public function numeroExiste($numero)
    {
        $where = array('numero' => $numero);

        $resultado = $this->db->get_where('processo', $where);

        return ($resultado->num_rows() == 1);
    }

    public function chaveEstaCorreta($chave)
    {
        $where = array('chave' => $chave);

        $resultado = $this->db->get_where('processo', $where);

        return ($resultado->num_rows() == 1);
    }
}