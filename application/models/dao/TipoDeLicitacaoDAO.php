<?php defined('BASEPATH') or exit('No direct script access allowed');

include('application/models/bo/TipoDeLicitacao.php');

class TipoDeLicitacaoDAO extends CI_Model
{
    public static $TABELA_DB = 'tipo_de_licitacao';

    public function __construct()
    {
        parent::__construct();
    }

    public function create($tipoDeLicitacao)
    {
        $this->db->insert(
            self::$TABELA_DB,
            array(
                'id' => $tipoDeLicitacao->id,
                'nome' => $tipoDeLicitacao->nome,
                'lei' => $tipoDeLicitacao->lei,
                'dataDaLei' => $tipoDeLicitacao->dataDaLei,
                'tipoDeLicitacao' => $tipoDeLicitacao->tipoDeLicitacao,
                'status' => $tipoDeLicitacao->status,
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

        $listaDetiposDeLicitacoes = array();

        foreach ($resultado->result() as $linha) {

            $tipoDeLicitacao = new TipoDeLicitacao(
                $linha->id,
                $linha->nome,
                $linha->lei,
                $linha->dataDaLei,
                $linha->status
            );

            array_push($listaDetiposDeLicitacoes, $tipoDeLicitacao);
        }
        return $listaDetiposDeLicitacoes;
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
                $linha->nome,
                $linha->lei,
                $linha->dataDaLei,
                $linha->status
            );
        }
    }

    public function update($tipoDeLicitacao)
    {

        $this->db->update(
            self::$TABELA_DB,
            array(
                'id' => $tipoDeLicitacao->id,
                'nome' => $tipoDeLicitacao->nome,
                'lei' => $tipoDeLicitacao->lei,
                'dataDaLei' => $tipoDeLicitacao->dataDaLei,
                'status' => $tipoDeLicitacao->status,
            ),
            array('id' => $tipoDeLicitacao->id)
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
        $tiposDeLicitacoes = $this->retrive(null, null);

        $options = [];

        if (isset($tiposDeLicitacoes)) {

            foreach ($tiposDeLicitacoes as $key => $value) {
                $options += [$value->id => $value->lei . ' (' . $value->dataDaLei . ')'];
            }

        }
        return $options;

    }
}