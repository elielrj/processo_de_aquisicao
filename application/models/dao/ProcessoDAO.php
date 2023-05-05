<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('application/models/bo/Processo.php');
include_once('InterfaceCrudDAO.php');

class ProcessoDAO extends CI_Model implements InterfaceCrudDAO
{

    public static $TABELA_DB = 'processo';

    public function __construct()
    {
        parent::__construct();
    }

    public function criar($objeto)
    {
        $this->db->insert(
            self::$TABELA_DB,
            $objeto
        );
    }

    public function buscar($indiceInicial, $quantidadeMostrar)
    {

        $resultado = $this->db
            ->order_by('data','DESC')
            ->get(
                self::$TABELA_DB,
                $quantidadeMostrar,
                $indiceInicial
            );

        $listaDeProcessos = array();

        foreach ($resultado->result() as $linha) {

            $processo = $this->toObject($linha);

            array_push($listaDeProcessos, $processo);
        }
        return $listaDeProcessos;
    }

    public function buscarPorId($objetoId)
    {

        $resultado = $this->db->get_where(
            self::$TABELA_DB,
            array('id' => $objetoId)
        );

        foreach ($resultado->result() as $linha) {

            return $this->toObject($linha);
        }
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

    public function buscarArquivosDoProcesso($processoId)
    {
        return $this->ArquivoDAO->buscarArquivosDeUmProcesso($processoId);
    }

    public function toArray($objeto)
    {
        return array(
            'id' => null,
            'objeto' => $objeto->objeto,
            'numero' => $objeto->numero,
            'data' => $objeto->data,
            'chave' => $objeto->chave,
            'departamento_id' => $objeto->departamento->id,
            'lei_id' => $objeto->lei->id,
            'tipo_id' => $objeto->tipo->id,
            'completo' => $objeto->completo,
            'status' => $objeto->status
        );
    }

    public function toObject($arrayList)
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