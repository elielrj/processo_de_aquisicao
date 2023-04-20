<?php defined('BASEPATH') or exit('No direct script access allowed');

include('application/models/bo/Arquivo.php');
include('I_Crud_DAO.php');

class ArquivoDAO extends CI_Model implements I_Crud_DAO
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
            $arquivo
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
                $linha->nome,
                $linha->path,
                $linha->nome_do_arquivo,
                $linha->data_do_upload,
                $this->ProcessoDAO->retriveId($linha->processo_id),
                $this->UsuarioDAO->retriveId($linha->usuario_id),
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
                $linha->nome,
                $linha->path,
                $linha->nome_do_arquivo,
                $linha->data_do_upload,
                $this->ProcessoDAO->retriveId($linha->processo_id),
                $this->UsuarioDAO->retriveId($linha->usuario_id),
                $linha->status
            );
        }
    }

    public function update($arquivo)
    {

        $this->db->update(
            self::$TABELA_DB,
            $arquivo,
            array('id' => $arquivo['id'])
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
}