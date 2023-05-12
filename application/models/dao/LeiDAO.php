<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('application/models/bo/Lei.php');
require_once('application/models/bo/Modalidade.php');

include_once('InterfaceCrudDAO.php');

class LeiDAO extends CI_Model implements InterfaceCrudDAO {

    public static $TABELA_DB = 'lei';

    public function __construct() {
        parent::__construct();
    }

    public function criar($objeto) {
        $this->db->create(
                self::$TABELA_DB,
                $objeto->transformarObjetoEmArray()
        );
    }

    public function buscar($indiceInicial, $quantidadeMostrar) {

        $resultado = $this->db
        ->where(array('status' => true))
        ->get(
                self::$TABELA_DB,
                $quantidadeMostrar,
                $indiceInicial
        );

        $listaDeLeis = array();

        foreach ($resultado->result() as $linha) {

            $lei = $this->toObject($linha);

            array_push($listaDeLeis, $lei);
        }
        return $listaDeLeis;
    }

    public function buscarPorId($id) {

        $resultado = $this->db->get_where(
                self::$TABELA_DB,
                array('id' => $id)
        );

        foreach ($resultado->result() as $linha) {
            return $this->toObject($linha);
        }
    }

    public function atualizar($objeto) {
        $this->db->update(
                self::$TABELA_DB,
                $objeto->transformarObjetoEmArray(),
                array('id' => $objeto->id)
        );
    }

    public function quantidade() {
        return $this->db
        ->where(array('status' => true))
        ->count_all_results(self::$TABELA_DB);
    }

    public function transformarArrayEmObjeto($arrayList) {
        return new Lei(
                $arrayList->id,
                $arrayList->numero,
                $arrayList->artigo,
                $arrayList->inciso,
                $arrayList->data,
                $this->ModalidadeDAO->buscarPorId($arrayList->modalidade_id),
                $arrayList->status
        );
    }

    public function ativar($objetoId) {
        $this->db->update(
                self::$TABELA_DB,
                array('id' => $objetoId),
                array('status' => true)
        );
    }

    public function desativar($objetoId) {
        $this->db->update(
                self::$TABELA_DB,
                array('id' => $objetoId),
                array('status' => false)
        );
    }

    public function options() {

        $leis = $this->buscar(null, null);

        $options = [];

        if (isset($leis)) {

            foreach ($leis as $key => $lei) {

                $options += [$lei->id => $lei->toString()];
            }
        }
        return $options;
    }

    private function buscarPorModalideId($modalidade_id)
    {     
        $resultado = $this->db->get_where(
            self::$TABELA_DB,
            array('modalidade_id' => $modalidade_id)
        );
        
        $listaDeLeis = array();

        foreach ($resultado->result() as $linha) {
            
            $lei = $this->toObject($linha);
            
            array_push($listaDeLeis, $lei);
        }
  
        return $listaDeLeis;
    }

    public function optionsDeLeisPorModalidadeId($modalidade_id)
    {
        
        $leis = $this->buscarPorModalideId($modalidade_id);

        $options = [];

        if (isset($leis)) {

            foreach ($leis as $key => $lei) {

                $options += array($lei->id => $lei->toString());
            }
        }
    

        return $options;
    }

}
