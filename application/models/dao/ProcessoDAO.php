<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('application/models/bo/Processo.php');
include_once('InterfaceCrudDAO.php');

class ProcessoDAO extends DAO
{

    public static $TABELA_DB = 'processo';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('DAO');
    }

    public function criar($processo)
    {
        $this->DAO->criar($this->TABELA_DB, $processo->toArray());
    }

    public function buscarTodos($inicial, $final)
    {
        $array = $this->DAO->buscarTodos($this->TABELA_DB, $inicial, $final);

        return $this->criarLista($array);
    }


    public function buscarTodosDesativados($inicial, $final)
    {
        $array = $this->DAO->buscarTodos($this->TABELA_DB, $inicial, $final);

        return $this->criarLista($array);
    }

    public function buscarPorId($usuarioId)
    {
        $array = $this->db->get_where($this->TABELA_DB, array('id' => $usuarioId));

        return $this->toObject($array->result());
    }

    public function buscarDepartamentoId($departamento_id)
    {

        $resultado = $this->db->get_where(
            self::$TABELA_DB,
            array('departamento_id' => $departamento_id)
        );

        $listaDeProcessos = array();

        foreach ($resultado->result() as $linha) {

            $processo = $this->toObject($linha);

            array_push($listaDeProcessos, $processo);
        }
        return $listaDeProcessos;
    }

    public function atualizar($objeto)
    {

        $this->db->update(
            self::$TABELA_DB,
            $this->toArray($objeto),
            array('id' => $objeto->id)
        );
    }

    public function desativar($objetoId)
    {
        return $this->db->update(
            self::$TABELA_DB,
            array('id' => $objetoId),
            array('status' => false)
        );
    }

    public function ativar($objetoId)
    {
        return $this->db->update(
            self::$TABELA_DB,
            array('id' => $objetoId),
            array('status' => true)
        );
    }

    public function quantidade()
    {
        return $this->db->count_all_results(self::$TABELA_DB);
    }

    public function options()
    {

        $processos = $this->buscar(null, null);

        $options = [];

        if (isset($processos)) {

            foreach ($processos as $key => $value) {

                $options += [$value->id => 'Nup/Nud: ' . $value->numero . ' - Objeto: ' . $value->objeto];
            }
        }
        return $options;
    }

    public function buscarProcessoPeloNumeroChave($numero, $chave)
    {

        $resultado = $this->db->get_where(
            self::$TABELA_DB,
            array(
                'numero' => $numero,
                'chave' => $chave
            )
        );

        foreach ($resultado->result() as $linha) {

            return $this->toObject($linha);
        }

    }

    public function buscarArquivosDoProcesso($processoId)
    {
        return $this->ArquivoDAO->buscarArquivosDeUmProcesso($processoId);
    }


    private function toObject($arrayList)
    {
        $processo = new Processo(
            $arrayList->id,
            $arrayList->objeto,
            $arrayList->numero,
            $arrayList->data,
            $arrayList->chave,
            $this->DepartamentoDAO->buscarPorId($arrayList->departamento_id),
            $this->LeiDAO->buscarPorId($arrayList->lei_id),
            $this->TipoDAO->buscarPorId($arrayList->tipo_id),
            $arrayList->completo,
            $arrayList->status
        );

        /**
         * LeiTipoArtefatoDAO vai buscar na tabela lei_tipo_artefato todo os artefatos 
         * (entre artefatos, tipos e lei), tem que ser passado os parâmetros lei_id e processo_id
         */
        $processo->tipo->listaDeArtefatos =
            $this->LeiTipoArtefatoDAO
                ->buscarListaDeArtefatos($processo->lei->id, $processo->tipo->id);

        foreach ($processo->tipo->listaDeArtefatos as $artefato) {

            $artefato->arquivo = $this->ArquivoDAO
                ->buscarArquivoDoArtefato($processo->id, $artefato->id);
        }

        return $processo;
    }

}