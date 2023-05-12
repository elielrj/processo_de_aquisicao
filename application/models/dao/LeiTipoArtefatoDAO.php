<?php

defined('BASEPATH') or exit('No direct script access allowed');

class LeiTipoArtefatoDAO extends CI_Model
{

    public static $TABEL_DB_LE_TIPO_ARTEFATO = 'lei_tipo_artefato';

    public function __construct()
    {
        $this->load->model('dao/ArtefatoDAO');
        $this->load->model('dao/DAO');
    }

    public function buscarListaDeArtefatos($lei_id, $tipo_id)
    {
        $array = $this->DAO->buscarOnde(self::$TABEL_DB_LE_TIPO_ARTEFATO, array('lei_id' => $lei_id, 'tipo_id' => $tipo_id));

        return $this->criarLista($array);
    }

    private function criarLista($array)
    {
        $listaDeArtefato = array();

        foreach ($array->result() as $linha) {

            $artefato = $this->toObject($linha);

            array_push($listaDeArtefato, $artefato);
        }

        return $listaDeArtefato;
    }

    private function toObject($array)
    {
        return $this->ArtefatoDAO->buscarPorId($array->artefato_id);
    }
}