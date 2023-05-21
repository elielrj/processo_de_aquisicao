<?php

class DAO extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function criar($banco, $array)
    {
        $this->db->insert($banco, $array);
    }

    public function buscarTodos($banco, $inicio, $fim)
    {
        return $this->db
            ->where(array('status' => true))
            ->order_by('id', 'DSC')
            ->get($banco, $inicio, $fim);
    }

    public function buscarTodosDesativados($banco, $inicio, $fim)
    {
        return $this->db
            ->where(array('status' => false))
            ->order_by('id', 'DSC')
            ->get($banco, $inicio, $fim);
    }

    public function buscarTodosAtivosInativos($banco, $inicio, $fim)
    {
        return $this->db
            ->order_by('id', 'DSC')
            ->get($banco, $inicio, $fim);
    }

    public function buscarTodosOrderBy($banco,$order_by, $inicio, $fim)
    {
        return $this->db
            ->order_by($order_by)
            ->get($banco, $inicio, $fim);
    }

    public function buscarPorId($banco, $id)
    {
        return $this->db->get_where($banco, array('id' => $id));
    }

    public function buscarOnde($banco, $array)
    {
        return $this->db
        ->get_where($banco,$array);
    }

    public function atualizar($banco, $array)
    {
        $this->db->update($banco, $array);
    }

    public function deletar($banco, $array)
    {
        $this->db->update($banco, $array);
    }

    public function contar($banco)
    {
        return $this->db
            ->where(array('status' => true))
            ->count_all_results($banco);
    }

    public function contarDesativados($banco)
    {
        return $this->db
            ->where(array('status' => false))
            ->count_all_results($banco);
    }

    public function contarAtivosInativos($banco)
    {
        return $this->db
            ->count_all_results($banco);
    }

}