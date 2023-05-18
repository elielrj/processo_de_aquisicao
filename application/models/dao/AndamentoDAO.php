<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('application/models/bo/Andamento.php');

class AndamentoDAO extends CI_Model
{

    public static $TABELA_DB = 'andamento';

    public function __construct()
    {
        $this->load->model('dao/DAO');
    }

    public function criar($objeto)
    {
        $this->DAO->criar(self::$TABELA_DB, $objeto->toArray());
    }

    public function atualizar($andamento)
    {
        $this->DAO->atualizar(self::$TABELA_DB, $andamento->toArray());
    }

    public function buscarPorId($processo_id)
    {
        $array = $this->DAO->buscarOnde(self::$TABELA_DB, array('processo_id' => $processo_id));
var_dump('AndamentoDAO->buscarId: ' . $array);
        return $this->toObject($array->result()[0]);
    }

    public static function toObject($arrayList)
    {
        return new Andamento(
            isset($arrayList->processo_id)
            ? $arrayList->processo_id
            : (isset($arrayList['processo_id']) ? $arrayList['processo_id'] : null),
            isset($arrayList->status_do_andamento)
            ? (Andamento::selecionarStatus($arrayList->status_do_andamento))
            : (isset($arrayList['status_do_andamento']) ? Andamento::selecionarStatus($arrayList['status_do_andamento']) : null),            
            isset($arrayList->data_hora)
            ? (DataLibrary::dataHoraBr($arrayList->data_hora))
            : (isset($arrayList['data_hora']) ? DataLibrary::dataHoraBr($arrayList['data_hora']) : null)
        );
    }

    private function criarLista($array)
    {
        $listaDeAndamento = array();

        foreach ($array->result() as $linha) {

            $andamento = $this->toObject($linha);

            array_push($listaDeAndamento, $andamento);
        }

        return $listaDeAndamento;
    }

    public function options()
    {
        $options = [Enviado::$NOME => Enviado::$NOME];
        $options += [Executado::$NOME => Executado::$NOME];
        $options += [Conformado::$NOME => Conformado::$NOME];
    }

}