<?php

defined('BASEPATH') or exit('No direct script access allowed');

include('application/models/bo/ItemDoIndice.php');

class ItemDoIndiceDAO extends CI_Model {

    public static $TABELA_DB = 'item_do_indice';

    public function __construct() {
        parent::__construct();
    }

    public function create($itemDoIndice, $indice_id) {
        $this->db->insert(
                self::$TABELA_DB,
                array(
                    'id' => $itemDoIndice->id,
                    'ordem' => $itemDoIndice->ordem,
                    'indice_id' => $indice_id,
                    'artefato_id' => $itemDoIndice->artefato->id,
                    'status' => $itemDoIndice->status
                )
        );
    }

    public function retrive($indiceInicial, $mostrar) {

        $resultado = $this->db->get(
                self::$TABELA_DB,
                $mostrar,
                $indiceInicial
        );

        $listaDeItemDoIndices = array();

        foreach ($resultado->result() as $linha) {

            $itemDoIndice = new ItemDoIndice(
                    $linha->id,
                    $linha->ordem,
                    $this->ArtefatoDAO->retriveId($linha->artefato_id),
                    $linha->status
            );

            array_push($listaDeItemDoIndices, $itemDoIndice);
        }
        return $listaDeItemDoIndices;
    }

    public function retriveId($id) {

        $resultado = $this->db->get_where(
                self::$TABELA_DB,
                array('id' => $id)
        );

        foreach ($resultado->result() as $linha) {

            return new ItemDoIndice(
                    $linha->id,
                    $linha->ordem,          
                    $this->ArtefatoDAO->retriveId($linha->artefato_id),
                    $linha->status
            );
        }
    }

    public function retriveIndiceId($indice_id) {

        $resultado = $this->db->get_where(
                self::$TABELA_DB,
                array('indice_id' => $indice_id)
        );

        $listaDeItensDoIndice = array();

        foreach ($resultado->result() as $linha) {

            $itemDoIndice = new ItemDoIndice(
                    $linha->id,
                    $linha->ordem,
                    $this->ArtefatoDAO->retriveId($linha->artefato_id),
                    $linha->status
            );

            array_push($listaDeItensDoIndice, $itemDoIndice);
        }
        return $listaDeItensDoIndice;
    }

    public function update($itemDoIndice) {

        $this->db->update(
                self::$TABELA_DB,
                array(
                    'id' => $itemDoIndice->id,
                    'ordem' => $itemDoIndice->ordem,
                    'artefato_id' => $itemDoIndice->artefato->id,
                    'status' => $itemDoIndice->status
                ),
                array('id' => $itemDoIndice->id)
        );
    }

    public function delete($id) {
        return $this->db->update(
                        self::$TABELA_DB,
                        array('status' => false),
                        array('id' => $id)
        );
    }

    public function count_rows() {
        return $this->db->count_all_results(self::$TABELA_DB);
    }

}
