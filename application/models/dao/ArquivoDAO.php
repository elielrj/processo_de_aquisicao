<?php defined('BASEPATH') or exit('No direct script access allowed');

include('application/models/bo/Arquivo.php');

class ArquivoDAO extends CI_Model
{

    public static $TABELA_DB = 'arquivo';

    public function __construct()
    {
        parent::__construct();
    }

    public function create($arquivo)
    {
        $this->db->insert(
            self::$TABELA_DB,
            array(
                'id' => $arquivo->id,
                'artefato' => $arquivo->artefato,
                'path' => $arquivo->path,
                'nome_do_arquivo' => $arquivo->nomeDoArquivo,
                'data_do_upload' => $arquivo->dataDoUpload,
                'processo_id' => $arquivo->processo->id,
                'status' => $arquivo->status,
            )
        );
    }

    public function retrive($indiceInicial, $mostrar)
    {

        $resultado = $this->db->get(
            self::$TABELA_DB,
            $mostrar,
            $indiceInicial
        );

        $listaDeArquivos = array();

        foreach ($resultado->result() as $linha) {
            $arquivo = new Arquivo(
                $linha->id,
                $linha->artefato,
                $linha->path,
                $linha->nome_do_arquivo,
                $linha->data_do_upload,
                $this->ProcessoDAO->retriveId($linha->processo_id),
                $linha->status
            );

            array_push($listaDeArquivos, $arquivo);
        }
        return $listaDeArquivos;

    }

    public function retriveId($id)
    {

        $resultado =
            $this->db->get_where(
                self::$TABELA_DB,
                array('id' => $id)
            );

        foreach ($resultado->result() as $linha) {
            return new Arquivo(
                $linha->id,
                $linha->artefato,
                $linha->path,
                $linha->nome_do_arquivo,
                $linha->data_do_upload,
                $this->ProcessoDAO->retriveId($linha->processo_id),
                $linha->status
            );
        }
    }

    public function update($arquivo)
    {

        $this->db->update(
            self::$TABELA_DB,
            array(
                'id' => $arquivo->id,
                'artefato' => $arquivo->artefato,
                'path' => $arquivo->path,
                'nome_do_arquivo' => $arquivo->nomeDoArquivo,
                'data_do_upload' => $arquivo->dataDoUpload,
                'processo_id' => $arquivo->processo->id,
                'status' => $arquivo->status,
            ),
            array('id' => $arquivo->id)
        );
    }

    public function delete($id)
    {
        return $this->db->delete(
            self::$TABELA_DB,
            array('id' => $id)
        );
    }

    public function count_rows()
    {
        return $this->db->count_all_results(self::$TABELA_DB);
    }

    public function buscarArquivosDeUmProcesso($processoId){
        $resultado =
            $this->db->get_where(
                self::$TABELA_DB,
                array('processo_id' => $processoId)
            );

        $listaDeArquivos = array();

        foreach ($resultado->result() as $linha) {
            
            $arquivo = new Arquivo(
                $linha->id,
                $linha->artefato,
                $linha->path,
                $linha->nome_do_arquivo,
                $linha->data_do_upload,
                null,
                $linha->status
            );
            
            array_push($listaDeArquivos, $arquivo);
        }
        return $listaDeArquivos;
    }
}