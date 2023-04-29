<?php

defined('BASEPATH') or exit('No direct script access allowed');

include('application/models/bo/Artefato.php');

class ArtefatoDAO extends CI_Model {

    public static $TABELA_DB = 'artefato';

    public function __construct() {
        parent::__construct();
    }

    public function create($artefato) {

        $this->db->insert(self::$TABELA_DB, Artefato::fromObjectToArray($artefato));
    }

    public function retrive($indiceInicial, $mostrar) {

        $resultado = $this->db->get(
                self::$TABELA_DB,
                $mostrar,
                $indiceInicial
        );

        $listaDeArtefatos = array();

        foreach ($resultado->result() as $linha) {
            array_push($listaDeArtefatos, Artefato::fromArrayToObject($linha));
        }
        return $listaDeArtefatos;
    }

    public function retriveId($id) {

        $resultado = $this->db->get_where(
                self::$TABELA_DB,
                array('id' => $id)
        );

        foreach ($resultado->result() as $linha) {
            return Artefato::fromArrayToObject($linha);
        }
    }

    public function update($artefato) {

        $this->db->update(
                self::$TABELA_DB,
                Artefato::fromObjectToArray($artefato),
                array('id' => $artefato->id)
        );
    }

    public function delete($id) {
        return $this->db->delete(
                        self::$TABELA_DB,
                        array('id' => $id)
        );
    }

    public function count_rows() {
        return $this->db->count_all_results(self::$TABELA_DB);
    }

    public function options() {

        $artefatos = $this->retrive(null, null);

        $options = [];

        if (isset($artefatos)) {

            foreach ($artefatos as $key => $value) {

                $options += [$value->id => $value->nome];
            }
        }
        return $options;
    }
}
