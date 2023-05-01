<?php

defined('BASEPATH') or exit('No direct script access allowed');

include('application/models/bo/Artefato.php');

class ArtefatoDAO extends CI_Model implements InterfaceCrudDAO {

    public static $TABELA_DB = 'artefato';

    public function __construct() {
        parent::__construct();
    }

    public function criar($objeto) {

        $this->db->insert(
                self::$TABELA_DB,
                array(
                    'id' => $objeto->id,
                    'nome' => $objeto->nome,
                    'status' => $objeto->status
        ));
    }

    public function retrive($indiceInicial, $mostrar) {

        $resultado = $this->db->get(
                self::$TABELA_DB,
                $mostrar,
                $indiceInicial
        );

        $listaDeArtefatos = array();

        foreach ($resultado->result() as $linha) {

            $artefato = new Artefato(
                    $linha->id,
                    $linha->nome,
                    $linha->status
            );

            array_push($listaDeArtefatos, $artefato);
        }
        return $listaDeArtefatos;
    }

    public function retriveId($id) {

        $resultado = $this->db->get_where(
                self::$TABELA_DB,
                array('id' => $id)
        );

        foreach ($resultado->result() as $linha) {
            return new Artefato(
                    $linha->id,
                    $linha->nome,
                    $linha->status
            );
        }
    }

    public function update($artefato) {

        $this->db->update(
                self::$TABELA_DB,
                array(
                    'id' => $artefato->id,
                    'nome' => $artefato->nome,
                    'status' => $artefato->status
                ),
                array('id' => $artefato->id)
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

    public function toArray($objeto) {
        return array(
            'id' => $objeto->id,
            'nome' => $objeto->nome,
            'arquivo_id' => $objeto->arquivo->id,
            'status' => $objeto->status
        );
    }

    public function toObject($arrayList) {
        return new Artefato(
                $arrayList->id,
                $arrayList->nome,
                $this->ArquivoDAO->buscarPorId($arrayList->arquivo_id),
                $arrayList->status
        );
    }

}
