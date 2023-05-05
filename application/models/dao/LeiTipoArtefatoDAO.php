<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('application/models/bo/Modalidade.php');
require_once('application/models/bo/Artefato.php');


class LeiTipoArtefatoDAO extends CI_Model  {

    public static $TABELA_DB = 'lei_tipo_artefato';

    public function __construct() {
        parent::__construct();
    }

    public function buscarListaDeArtefatos($lei_id,$tipo_id) {
        
        $resultado = $this->db
                ->where(array('lei_id' => $lei_id, 'tipo_id' => $tipo_id))
                ->get(self::$TABELA_DB);

        $listaDeArtefatos = array();

        foreach ($resultado->result() as $linha) {

            $artefato = $this->toObjectArtefato($linha);

            array_push($listaDeArtefatos, $artefato);
        }

        return $listaDeArtefatos;
    }

   

    public function toArray($objeto) {
        return array(
            'id' => $objeto->modalidade_id,
            'nome' => $objeto->artefato_id,
            'status' => $objeto->status
        );
    }

    public function toObjectArtefato($arrayList) {
        return $this->ArtefatoDAO->buscarPorId($arrayList->artefato_id);
    }

}
