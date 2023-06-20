<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('application/models/bo/Arquivo.php');

class ArquivoDAO extends CI_Model
{

    public static $TABELA_DB = 'arquivo';

    public function __construct()
    {
        $this->load->model('dao/DAO');
    }

    public function criar($objeto)
    {
        $this->DAO->criar(self::$TABELA_DB, $objeto->array());
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

    public function buscarPorId($arquivoId)
    {
        $array = $this->DAO->buscarPorId(self::$TABELA_DB, $arquivoId);

        return $this->toObject($array->result()[0]);
    }

    public function buscarOnde($key, $value)
    {
        $array = $this->DAO->buscarOnde(self::$TABELA_DB, array($key => $value));

        return $this->criarLista($array->result());
    }

    public function atualizar($arquivo)
    {
        $this->DAO->atualizar(self::$TABELA_DB, $arquivo->array());
    }


    public function deletar($arquivo)
    {
        $this->DAO->deletar(self::$TABELA_DB, $arquivo->array());
    }

    public function contar()
    {
        return $this->DAO->contar(self::$TABELA_DB);
    }

    public function contarDesativados()
    {
        return $this->DAO->contarDesativados(self::$TABELA_DB);
    }

    public function toObject($arrayList)
    {
        return new Arquivo(
            $arrayList->id ?? ($arrayList['id'] ?? null),
			$arrayList->path ?? ($arrayList['path'] ?? null),
			$arrayList->data_hora ?? ($arrayList['data_hora'] ?? null),
			$arrayList->usuario_id ?? ($arrayList['usuario_id'] ?? null),
			$arrayList->artefato_id ?? ($arrayList['artefato_id'] ?? null),
			$arrayList->processo_id ?? ($arrayList['processo_id'] ?? null),
			$arrayList->nome ?? ($arrayList['nome'] ?? ''),
			$arrayList->status ?? ($arrayList['status'] ?? null)
        );
    }

    private function criarLista($array)
    {
        $listaDeArquivo = array();

        foreach ($array->result() as $linha) {

            $arquivo = $this->toObject($linha);

            $listaDeArquivo[] = $arquivo;
        }

        return $listaDeArquivo;
    }

    public function buscarArquivosDeUmProcesso($processoId)
    {
        $array = $this->buscarOnde('processo_id', $processoId);

        return $this->criarLista($array);
    }

    public function buscarArquivoDoArtefato($processoId, $artefatoId)
    {
        $whare = array('processo_id' => $processoId, 'artefato_id' => $artefatoId);

        $array = $this->DAO->buscarOnde(self::$TABELA_DB, $whare);

        if (!empty($array->result())) {

            $arquivos = [];

            foreach($array->result() as $linha){

                $arquivo = $this->toObject($linha);

                array_push($arquivos,$arquivo);

            }

            return $arquivos;

        } else {
            return null;
        }
    }

}
