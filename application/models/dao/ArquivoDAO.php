<?php

defined('BASEPATH') or exit('No direct script access allowed');

include('application/models/bo/Arquivo.php');

class ArquivoDAO extends CI_Model implements InterfaceCrudDAO {

    public static $TABELA_DB = 'arquivo';

    public function __construct() {
        parent::__construct();
    }

    public function criar($objeto) {
        $this->db->insert(
                self::$TABELA_DB,
                $this->toArray($objeto);
        );
    }

    public function buscar($indiceInicial, $quantidadeMostrar) {

        $resultado = $this->db->get(
                self::$TABELA_DB,
                $quantidadeMostrar,
                $indiceInicial
        );

        $listaDeArquivos = array();

        foreach ($resultado->result() as $linha) {
            $arquivo = new Arquivo(
                    $linha->id,
                    $linha->path,
                    $linha->nome_do_arquivo,
                    $linha->data_do_upload,
                    $this->ProcessoDAO->retriveId($linha->processo_id),
                    $this->ArtefatoDAO->retriveId($linha->artefato_id),
                    $linha->status
            );

            array_push($listaDeArquivos, $arquivo);
        }
        return $listaDeArquivos;
    }

    public function buscarPorId($id) {

        $resultado = $this->db->get_where(
                self::$TABELA_DB,
                array('id' => $id)
        );

        foreach ($resultado->result() as $linha) {
            return new Arquivo(
                    $linha->id,
                    $linha->path,
                    $linha->nome_do_arquivo,
                    $linha->data_do_upload,
                    $this->ProcessoDAO->retriveId($linha->processo_id),
                    $this->ArtefatoDAO->retriveId($linha->artefato_id),
                    $linha->status
            );
        }
    }

    public function atualizar($objeto) {

        $this->db->update(
                self::$TABELA_DB,
                array(
                    'id' => $objeto->id,
                    'path' => $objeto->path,
                    'nome_do_arquivo' => $objeto->nomeDoArquivo,
                    'data_do_upload' => $objeto->dataDoUpload,
                    'processo_id' => $objeto->processo->id,
                    'artefato_id' => $objeto->artefato->id,
                    'status' => $objeto->status,
                ),
                array('id' => $objeto->id)
        );
    }

    public function desativar($objetoId) {
        return $this->db->update(
                        self::$TABELA_DB,
                        array('id' => $objetoId),
                        array('status' => false)
        );
    }

    public function ativar($objetoId) {
        return $this->db->update(
                        self::$TABELA_DB,
                        array('id' => $objetoId),
                        array('status' => true)
        );
    }

    public function count_rows() {
        return $this->db->count_all_results(self::$TABELA_DB);
    }

    public function buscarArquivosDeUmProcesso($processoId) {
        $resultado = $this->db->get_where(
                self::$TABELA_DB,
                array('processo_id' => $processoId)
        );

        $listaDeArquivos = array();

        foreach ($resultado->result() as $linha) {

            $arquivo = array_push($listaDeArquivos, $arquivo);
        }
        return $listaDeArquivos;
    }

    public function toArray($objeto) {
        return array(
            'id' => $objeto->id,
            'path' => $objeto->path,
            'data' => $objeto->data,
            'status' => $objeto->status
        );
    }

    public function toObject($arrayList) {
        return new Arquivo(
                $arrayList->id,
                $arrayList->path,
                $arrayList->data,
                $arrayList->status
        );
    }

}
