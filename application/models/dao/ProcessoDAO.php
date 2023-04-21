<?php defined('BASEPATH') or exit('No direct script access allowed');

include('application/models/bo/Processo.php');

class ProcessoDAO extends CI_Model 
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
            array(
                'id' => $processo->id,
                'objeto' => $processo->objeto,
                'nup_nud' => $processo->nupNud,
                'data_do_processo' => $processo->dataDoProcesso,
                'chave_de_acesso' => $processo->chaveDeAcesso,
                'usuario_id' => $processo->usuario->id,
                'status' => $processo->status,
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

            array_push($listaDeProcessos,$processo);
        }
        return $listaDeProcessos;
    }

    public function retriveId($id)
    {

        $resultado =
            $this->db->get_where(
                self::$TABELA_DB,
                array('id' => $id)
            );

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

    public function update($processo)
    {

        $this->db->update(
            self::$TABELA_DB,
            array(
                'id' => $processo->id,
                'objeto' => $processo->objeto,
                'nup_nud' => $processo->nupNud,
                'data_do_processo' => $processo->dataDoProcesso,
                'chave_de_acesso' => $processo->chaveDeAcesso,
                'usuario_id' => $processo->usuario->id,
                'status' => $processo->status,
            ),
            array('id' => $processo->id)
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

    public function options()
    {

        $processos = $this->retrive(null, null);

        $options = "<option value=''>Selecione uma Processo</option>";

        if (isset($processos)) {
            foreach ($processos as $key => $value) {
                $options .= "<option value='{$value->id}'>" . $value->objeto . ' (Nup/Nud: ' . $value->nupNud . ')' . "</option>";
            }
        }
        return $options;

    }
}

