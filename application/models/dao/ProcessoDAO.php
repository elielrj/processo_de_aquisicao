<?php defined('BASEPATH') or exit('No direct script access allowed');

include('application/models/bo/Processo.php');
include('I_Crud_DAO.php');

class ProcessoDAO extends CI_Model implements I_Crud_DAO
{

    public static $TABELA_DB = 'processo';

    public function __construct()
    {
        parent::__construct();
    }

    public function create($processo)
    {
        $this->db->insert(
            self::$TABELA_DB,
            $processo
        );
    }

    public function retrive($indiceInicial, $mostrar)
    {

        $resultado = $this->db->get(
            self::$TABELA_DB,
            $mostrar,
            $indiceInicial
        );

        $listaDeProcessos = array();

        foreach ($resultado->result() as $linha) {

            return new Processo(
                $linha->id,
                $linha->objeto,
                $linha->nup_nud,
                $linha->data_do_processo,
                $linha->chave_de_acesso,
                $this->UsuarioDAO->retriveId($linha->usuario_id),
                $linha->status
            );
        }
    }

    public function retriveId($id)
    {

        $resultado =
            $this->db->get_where(
                self::$TABELA_DB,
                array('id' => $id)
            );

        $listaDeProcessos = array();

        foreach ($resultado->result() as $linha) {

            $processo = new Processo(
                $linha->id,
                $linha->objeto,
                $linha->nup_nud,
                $linha->data_do_processo,
                $linha->chave_de_acesso,
                $this->UsuarioDAO->retriveId($linha->usuario_id),
                $linha->status
            );

            array_push($listaDeProcessos, $processo);
        }
        return $listaDeProcessos;
    }

    public function update($processo)
    {

        $this->db->update(
            self::$TABELA_DB,
            array(
                'objeto' => $processo['objeto'],
                'nup_nud' => $processo['nup_nud'],
            ),
            array('id' => $processo['id'])
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