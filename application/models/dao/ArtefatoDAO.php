<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('application/models/bo/Artefato.php');

class ArtefatoDAO extends CI_Model
{

    public static $TABELA_DB = 'artefato';

    public function __construct()
    {
        $this->load->model('dao/DAO');
    }

    public function criar($objeto)
    {
        $this->DAO->criar(self::$TABELA_DB, $objeto->toArray());
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

    public function buscarPorId($artefatoId)
    {
        $array = $this->DAO->buscarPorId(self::$TABELA_DB, $artefatoId);

        return $this->toObject($array->result()[0]);
    }

    public function buscarOnde($key, $value)
    {
        $array = $this->DAO->buscarOnde(self::$TABELA_DB, array($key => $value));

        return $this->criarLista($array->result());
    }

    public function atualizar($artefato)
    {
        $this->DAO->atualizar(self::$TABELA_DB, $artefato->toArray());
    }


    public function deletar($artefato)
    {
        $this->DAO->deletar(self::$TABELA_DB, $artefato->toArray());
    }

    public function contar()
    {
        return $this->DAO->contar(self::$TABELA_DB);
    }

    public function contarDesativados()
    {
        return $this->DAO->contarDesativados(self::$TABELA_DB);
    }

    /**
     * Summary of toObject
     * @param mixed $arrayList
     * @return Artefato
     * Este método não buscar o Arquivo do artefato, 
     * pois quem tem essa responsabilidade é ProcessoDAO
     */
    public function toObject($arrayList)
    {
        return new Artefato(
            $arrayList->id,
            $arrayList->ordem,
            $arrayList->nome,
            null,
            $arrayList->status
        );
    }

    private function criarLista($array)
    {
        $listaDeArtefato = array();

        foreach ($array->result() as $linha) {

            $artefato = $this->toObject($linha);

            array_push($listaDeArtefato, $artefato);
        }

        return $listaDeArtefato;
    }

    public function options()
    {

        $artefatos = $this->buscarTodos(null, null);

        $options = [];

        if (isset($artefatos)) {

            foreach ($artefatos as $value) {

                $options += [$value->id => $value->nome];
            }
        }
        return $options;
    }

}