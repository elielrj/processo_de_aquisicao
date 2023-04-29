<?php defined('BASEPATH') or exit('No direct script access allowed');

include('application/models/bo/Indice.php');

class IndiceDAO extends CI_Model
{

    public static $TABELA_DB = 'indice';

    public function __construct()
    {
        parent::__construct();
    }

    public function create($indice)
    {
        $this->db->insert(
            self::$TABELA_DB,
            array(
                'nome' => $indice->nupNud,
                'tipo_de_licitacao_id' => $indice->tipoDeLicitacao->id,
                'status' => $indice->status,
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

        $listaDeIndices = array();

        foreach ($resultado->result() as $linha) {

            $indice = new Indice(
                $linha->id,
                $this->TipoDeLicitacaoDAO->retriveId($linha->tipo_de_licitacao_id),
                $linha->status
            );

            array_push($listaDeIndices, $indice);
        }
        return $listaDeIndices;
    }

    public function retriveId($id)
    {

        $resultado =
            $this->db->get_where(
                self::$TABELA_DB,
                array('id' => $id)
            );

        foreach ($resultado->result() as $linha) {

            return new TipoDeLicitacao(
                $linha->id,
                $this->TipoDeLicitacaoDAO->retriveId($linha->tipo_de_licitacao_id),
                $linha->status
            );
        }
    }

    public function update($indice)
    {

        $this->db->update(
            self::$TABELA_DB,
            array(
                'id' => $indice->id,
                'tipo_de_licitacao_id' => $indice->tipoDeLicitacao->id,
                'status' => $indice->status,
            ),
            array('id' => $indice->id)
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

        $indices = $this->retrive(null, null);

        $options = [];

        if (isset($indices)) {

            foreach ($indices as $key => $value) {

                $options += [$value->id => $value->tipoDeLicitacao->nome];
            }
        }
        return $options;

    }
}