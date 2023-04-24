<?php defined('BASEPATH') or exit('No direct script access allowed');

include('application/models/bo/Departamento.php');

class DepartamentoDAO extends CI_Model
{
    public static $TABELA_DB = 'departamento';

    public function __construct()
    {
        parent::__construct();
    }

    public function create($departamento)
    {
        $this->db->insert(
            self::$TABELA_DB,
            array(
                'id' => $departamento->id,
                'nome' => $departamento->nome,
                'sigla' => $departamento->sigla,
                'status' => $departamento->status,
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

        $listaDeDepartamentos = array();

        foreach ($resultado->result() as $linha) {

            $departamento = new Departamento(
                $linha->id,
                $linha->nome,
                $linha->sigla,
                $linha->status
            );

            array_push($listaDeDepartamentos, $departamento);
        }
        return $listaDeDepartamentos;
    }

    public function retriveId($id)
    {
        $resultado =
            $this->db->get_where(
                self::$TABELA_DB,
                array('id' => $id)
            );

        foreach ($resultado->result() as $linha) {

            return new Departamento(
                $linha->id,
                $linha->nome,
                $linha->sigla,
                $linha->status
                //$this->ProcessoDAO->retriveDepartamentoId($linha->id) //passa o Id do Departamento e trás todos os processos daquele departamento
            );
        }
    }

    public function update($departamento)
    {

        $this->db->update(
            self::$TABELA_DB,
            array(
                'id' => $departamento->id,
                'nome' => $departamento->nome,
                'sigla' => $departamento->sigla,
                'status' => $departamento->status,
            ),
            array('id' => $departamento->id)
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
        $departamentos = $this->retrive(null, null);

        $options = [];

        if (isset($departamentos)) {

            foreach ($departamentos as $key => $value) {
                $options += [$value->id => $value->nome . ' (' . $value->sigla . ')'];
            }

        }
        return $options;

    }
}