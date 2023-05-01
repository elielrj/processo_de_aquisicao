<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('application/models/bo/Modalidade.php');
require_once('application/models/bo/Artefato.php');


class ModalidadeArtefatoDAO extends CI_Model  {

    public static $TABELA_DB = 'modalidade_artefato';

    public function __construct() {
        parent::__construct();
    }

    public function buscarListaDeArtefatos($modalidadeId) {
        
        $resultado = $this->db
                ->where('modalidade_id', $modalidadeId)
                ->order_by('artefato_id')
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
