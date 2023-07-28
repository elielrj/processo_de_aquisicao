<?php

require_once 'AbstractDAO.php';

class TipoDAO  extends AbstractDAO
{
	const TABELA_TIPO = 'tipo';

	public function __construct()
	{
		$this->load->model('dao/DAO');
	}

	public function criar($objeto)
	{
		$this->DAO->criar(TipoDAO::TABELA_TIPO, $objeto->array());
	}

	public function buscarTodos($inicial, $final)
	{
		$array = $this->DAO->buscarTodos(TipoDAO::TABELA_TIPO, $inicial, $final);

		return $this->criarLista($array);
	}

	public function buscarTodosDesativados($inicial, $final)
	{
		$array = $this->DAO->buscarTodosDesativados(TipoDAO::TABELA_TIPO, $inicial, $final);

		return $this->criarLista($array);
	}

	public function buscarPorId($tipoId)
	{
		$array = $this->DAO->buscarPorId(TipoDAO::TABELA_TIPO, $tipoId);

		return $this->toObject($array->result()[0]);
	}

	public function buscarOnde($key, $value)
	{
		$array = $this->DAO->buscarOnde(TipoDAO::TABELA_TIPO, array($key => $value));

		return $this->criarLista($array->result());
	}

	public function atualizar($tipo)
	{
		$this->DAO->atualizar(TipoDAO::TABELA_TIPO, $tipo->array());
	}


	public function deletar($tipo)
	{
		$this->DAO->deletar(TipoDAO::TABELA_TIPO, $tipo->array());
	}

	public function contar()
	{
		return $this->DAO->contar(TABELA_TIPO);
	}

	public function contarDesativados()
	{
		return $this->DAO->contarDesativados(TABELA_TIPO);
	}

	private function toObject($arrayList)
	{
		return new Tipo(
			$arrayList->id ?? ($arrayList['id'] ?? null),
			$arrayList->nome ?? ($arrayList['nome'] ?? null),
			$arrayList->status ?? ($arrayList['status'] ?? null)
		);
	}

	private function criarLista($array)
	{
		$listaDeTipo = array();

		foreach ($array->result() as $linha) {

			$tipo = $this->toObject($linha);

			$listaDeTipo[] = $tipo;
		}

		return $listaDeTipo;
	}

	public function options()
	{

		$tipos = $this->buscarTodos(null, null);

		$options = [];

		if (isset($tipos)) {

			foreach ($tipos as $key => $tipo) {

				$options += [$tipo->id => $tipo->nome];
			}
		}

		return $options;
	}
	public function array()
	{
		return array(
			'id' => $this->id ?? null,
			'nome' => $this->nome,
			'status' => $this->status
		);
	}

}
