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
			->order_by('id', 'DESC')
			->get($banco, $inicio, $fim);
	}

	public function buscarTodosDesativados($banco, $inicio, $fim)
	{
		return $this->db
			->where(array('status' => false))
			->order_by('id', 'DESC')
			->get($banco, $inicio, $fim);
	}

	public function buscarTodosAtivosInativos($banco, $inicio, $fim)
	{
		return $this->db
			->order_by('id', 'DESC')
			->get($banco, $inicio, $fim);
	}

	public function buscarTodosAtivosInativosOrderByProcessoId($banco, $inicio, $fim)
	{
		return $this->db
			->order_by('processo_id', 'DESC')
			->get($banco, $inicio, $fim);
	}

	public function buscarTodosOrderByData($banco, $inicio, $fim,$where = [])
	{
		return $this->db
			->order_by('data_hora', 'DESC')
			->where($where)
			->get($banco, $inicio, $fim);
	}

	public function buscarTodosOrderBy($banco, $order_by, $inicio, $fim)
	{
		return $this->db
			->order_by($order_by, 'ASC')
			->get($banco, $inicio, $fim);
	}

	public function buscarPorId($banco, $id)
	{
		return $this->db->get_where($banco, array('id' => $id));
	}

	public function buscarOnde($banco, $array)
	{
		return $this->db
			->get_where($banco, $array);
	}

	public function buscarOndeOrderById($banco, $array)
	{
		return $this->db
			->order_by('id', 'DESC')
			->get_where($banco, $array);
	}

	public function atualizar($banco, $array)
	{
		$this->db->update($banco, $array, array('id' => $array['id']));
	}

	public function deletar($banco, $array)
	{
		$this->db->delete($banco, $array);
	}

	public function contar($banco, $where = ['status' => true])
	{
		return $this->db
			->where($where)
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
