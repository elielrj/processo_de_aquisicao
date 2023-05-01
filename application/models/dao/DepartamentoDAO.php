<?php

defined('BASEPATH') or exit('No direct script access allowed');

include('application/models/bo/Departamento.php');

class DepartamentoDAO extends CI_Model implements InterfaceCrudDAO{

    public static $TABELA_DB = 'departamento';

    public function __construct() {
        parent::__construct();
    }

    public function criar($objeto) {
        $this->db->insert(
                self::$TABELA_DB,
                $this->toArray($objeto)
        );
    }

    public function retrive($indiceInicial, $mostrar) {

        $resultado = $this->db->get(
                self::$TABELA_DB,
                $mostrar,
                $indiceInicial
        );

        $listaDeDepartamentos = array();

        foreach ($resultado->result() as $linha) {

            $departamento = $this->toObject($linha);

            array_push($listaDeDepartamentos, $departamento);
        }
        return $listaDeDepartamentos;
    }

    public function retriveId($id) {
        $resultado = $this->db->get_where(
                self::$TABELA_DB,
                array('id' => $id)
        );

        foreach ($resultado->result() as $linha) {

            return $this->toObject($linha);
        }
    }

    public function update($departamento) {

        $this->db->update(
                self::$TABELA_DB,
                $this->toArray($departamento),
                array('id' => $departamento->id)
        );
    }

    public function count_rows() {
        return $this->db->count_all_results(self::$TABELA_DB);
    }

    public function options() {
        $departamentos = $this->retrive(null, null);

        $options = [];

        if (isset($departamentos)) {

            foreach ($departamentos as $key => $value) {
                $options += [$value->id => $value->nome . ' (' . $value->sigla . ')'];
            }
        }
        return $options;
    }
    
    public function listarProcessos(){
        
        $usuario = $this->UsuarioDAO->retriveUsuarioAtual();
        $listaDeUsuarios= $this->UsuarioDAO->retriveUsuariosPeloDepartamentoId($usuario->departamento->id);
        
        return $listaDeUsuarios;
    }
    
    public function listarUsuarios(){
        
        $usuario = $this->UsuarioDAO->retriveUsuarioAtual();
        
        $listaDeProcessos = $this->ProcessoDAO->retriveDepartamentoId($usuario->departamento->id);
        
        return $listaDeProcessos;
    }

    public function toArray($departamento) {
        return array(
            'id' => $departamento->id,
            'nome' => $departamento->nome,
            'sigla' => $departamento->sigla,
            'ug_id' => $departamento->ug->id,
            'status' => $departamento->status
        );
    }

    public function toObject($arrayList) {
        return new Departamento(
                $arrayList->id,
                $arrayList->nome,
                $arrayList->sigla,
                $this->UgDAO->buscarPorId($arrayList->ug_id),
                $arrayList->status
        );
    }

}
