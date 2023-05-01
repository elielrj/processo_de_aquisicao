<?php

defined('BASEPATH') or exit('No direct script access allowed');

include('application/models/bo/TipoDeLicitacao.php');

class ModalidadeDAO extends CI_Model implements InterfaceCrudDAO {

    public static $TABELA_DB = 'modalidade';

    public function __construct() {
        parent::__construct();
    }

    public function criar($objeto) {
        $this->db->insert(
                self::$TABELA_DB,
                $this->toArray($objeto)
        );
    }

    public function buscar($indiceInicial, $quantidadeMostrar) {

        $resultado = $this->db->get(
                self::$TABELA_DB,
                $quantidadeMostrar,
                $indiceInicial
        );

        $listaDeModalidades = array();

        foreach ($resultado->result() as $linha) {

            $modalidade = $this->toObject($linha);

            array_push($listaDeModalidades, $modalidade);
        }
        
        return $listaDeModalidades;
    }

    public function buscarPorId($objetoId) {
        $resultado = $this->db->get_where(
                self::$TABELA_DB,
                array('id' => $objetoId)
        );

        foreach ($resultado->result() as $linha) {

            return new TipoDeLicitacao(
                    $linha->id,
                    $linha->nome,
                    $linha->lei,
                    $linha->artigo,
                    $linha->inciso,
                    $linha->data_da_lei,
                    $linha->pagina,
                    $linha->status
            );
        }
    }

    public function atualizar($objeto) {

        $this->db->update(
                self::$TABELA_DB,
                $this->toArray($objeto),
                 array('id' => $objeto->id)
        );
    }

    public function desativar($objetoId) {
        return $this->db->update(
                        self::$TABELA_DB,
                        array('id' => $objetoId),
                        array('status' => false),
        );
    }

    public function ativar($objetoId) {
        return $this->db->update(
                        self::$TABELA_DB,
                        array('id' => $objetoId),
                        array('status' => true),
        );
    }

    public function quantidade() {
        return $this->db->count_all_results(self::$TABELA_DB);
    }

    public function options() {
        $tiposDeLicitacoes = $this->retrive(null, null);

        $options = [];

        if (isset($tiposDeLicitacoes)) {

            foreach ($tiposDeLicitacoes as $key => $value) {

                $artigo = ($value->artigo != '') ? (', ' . $value->artigo) : '';
                $inciso = ($value->inciso != '') ? (', ' . $value->inciso) : '';

                $options += [$value->id => $value->nome . ' (' . 'Lei ' . $value->lei . $artigo . $inciso . ", de " . (new DateTime($value->dataDaLei))->format('d-m-Y') . ')'];
            }
        }
        return $options;
    }

    public function toArray($objeto) {
        return array(
            'id' => $objeto->id,
            'nome' => $objeto->nome,
            'lei_id' => $objeto->lei->id,
            'status' => $objeto->status,
        );
    }

    public function toObject($arrayList) {
        return new Modalidade(
                $arrayList->id,
                $arrayList->nome,
                $this->ModalidadeDAO->buscarPorId($arrayList->lei_id),
                $arrayList->status
        );
    }

}
