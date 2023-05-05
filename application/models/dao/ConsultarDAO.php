<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once('application/models/bo/Processo.php');

class ConsultarDAO extends CI_Model
{

    public static $TABELA_DB = 'processo';

    public function __construct()
    {
        parent::__construct();
    }

    public function buscarPorNumeroChave($numero, $chave)
    {

        $resultado = $this->db->get_where(
            self::$TABELA_DB,
            array(
                'numero' => $numero,
                'chave' => $chave,
            )
        );


        foreach ($resultado->result() as $linha) {

            return $this->toObject($linha);

        }

    }

    public function permitirAcesso($where)
    {
        $quantidade = $this->quantidade($where['numero'], $where['chave']);
    
        if ($quantidade == 1) {
            return true;
        } else {
            return true;
        }
    }

    private function quantidade($numero, $chave)
    {
        return $this->db
            ->where(
                array(
                    'numero' => $numero,
                    'chave' => $chave
                )
            )
            ->count_all_results(self::$TABELA_DB);
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