<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('application/models/bo/Processo.php');

class ProcessoDAO extends CI_Model
{

    public static $TABELA_DB = 'processo';

    public function __construct()
    {
        $this->load->model('dao/DAO');
        $this->load->model('dao/DepartamentoDAO');
        $this->load->model('dao/LeiDAO');
        $this->load->model('dao/TipoDAO');
        $this->load->model('dao/LeiTipoArtefatoDAO');
        $this->load->model('dao/ArquivoDAO');
        $this->load->model('dao/AndamentoDAO');
    }

    public function criar($processo)
    {
        $this->DAO->criar(self::$TABELA_DB, $processo->toArray());
    }

    public function buscarTodos($inicial, $final)
    {
        $array = $this->DAO->buscarTodos(self::$TABELA_DB, $inicial, $final);

        return $this->criarLista($array);
    }


    public function buscarTodosDesativados($inicial, $final)
    {
        $array = $this->DAO->buscarTodosDesativados(self::$TABELA_DB, $inicial, $final);

        return $this->criarLista($array);
    }

    public function buscarPorId($processoId)
    {
        $array = $this->DAO->buscarPorId(self::$TABELA_DB, $processoId);

        return $this->toObject($array->result()[0]);
    }

    public function buscarOnde($key, $value)
    {
        $array = $this->DAO->buscarOnde(self::$TABELA_DB, array($key => $value));

        return $this->criarLista($array->result());
    }

    public function atualizar($processo)
    {
        $this->DAO->atualizar(self::$TABELA_DB, $processo->toArray());
    }

    public function deletar($processo)
    {
        $this->DAO->deletar(self::$TABELA_DB, $processo->toArray());
    }

    public function contar()
    {
        return $this->DAO->contar(self::$TABELA_DB);
    }

    public function contarDesativados()
    {
        return $this->DAO->contarDesativados(self::$TABELA_DB);
    }

    private function toObject($arrayList)
    {
        $processo = new Processo(
            isset($arrayList->id) ? $arrayList->id : (isset($arrayList['id']) ? $arrayList['id'] : null),
            isset($arrayList->objeto) ? $arrayList->objeto : (isset($arrayList['objeto']) ? $arrayList['objeto'] : null),
            isset($arrayList->numero) ? $arrayList->numero : (isset($arrayList['numero']) ? $arrayList['numero'] : null),
            isset($arrayList->data_hora) ? $arrayList->data_hora : (isset($arrayList['data_hora']) ? $arrayList['data_hora'] : null),
            isset($arrayList->chave) ? $arrayList->chave : (isset($arrayList['chave']) ? $arrayList['chave'] : null),
            isset($arrayList->departamento_id) ? $this->DepartamentoDAO->buscarPorId($arrayList->departamento_id) : (isset($arrayList['departamento_id']) ? $this->DepartamentoDAO->buscarPorId($arrayList['departamento_id']) : null),
            isset($arrayList->lei_id) ? $this->LeiDAO->buscarPorId($arrayList->lei_id) : (isset($arrayList['lei_id']) ? $this->LeiDAO->buscarPorId($arrayList['lei_id']) : null),
            isset($arrayList->tipo_id) ? $this->TipoDAO->buscarPorId($arrayList->tipo_id) : (isset($arrayList['tipo_id']) ? $this->TipoDAO->buscarPorId($arrayList['tipo_id']) : null),
            isset($arrayList->completo) ? $arrayList->completo : (isset($arrayList['completo']) ? $arrayList['completo'] : null),
            isset($arrayList->andamento_id) ? $this->AndamentoDAO->buscarPorId($arrayList->andamento_id) : (isset($arrayList['andamento_id']) ? $this->AndamentoDAO->buscarPorId($arrayList['andamento_id']) : null),
            isset($arrayList->status) ? $arrayList->status : (isset($arrayList['status']) ? $arrayList['status'] : null)
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

    private function criarLista($array)
    {
        $listaDeProcesso = array();

        foreach ($array->result() as $linha) {

            $processo = $this->toObject($linha);

            array_push($listaDeProcesso, $processo);
        }

        return $listaDeProcesso;
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
        $array = $this->DAO->buscarOnde(self::$TABELA_DB, array('numero' => $numero, 'chave' => $chave));

        if (isset($array)) {
            return $this->toObject($array->result()[0]);
        } else {
            return null;
        }
    }
}