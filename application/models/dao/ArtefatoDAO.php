<?php

require_once 'AbstractDAO.php';

class ArtefatoDAO  extends AbstractDAO
{
	const TABELA_ARTERFATO = 'artefato';

	public function __construct()
	{
		parent::__construct();
	}

	public function criar($objeto)
	{
		$this->DAO->criar(ArtefatoDAO::TABELA_ARTERFATO, $objeto->array());
	}

	public function buscarTodos($qtd_de_itens_para_exibir, $indice_no_data_base)
	{
		$array = $this->DAO->buscarTodos(ArtefatoDAO::TABELA_ARTERFATO, $qtd_de_itens_para_exibir, $indice_no_data_base); //($qtd_de_itens_para_exibir,$indice_no_data_base)

		return $this->criarLista($array);
	}

	public function buscarTodosDesativados($inicial, $final)
	{
		$array = $this->DAO->buscarTodosDesativados(ArtefatoDAO::TABELA_ARTERFATO, $inicial, $final);

		return $this->criarLista($array);
	}

	public function buscarPorId($artefatoId)
	{
		$array = $this->DAO->buscarPorId(ArtefatoDAO::TABELA_ARTERFATO, $artefatoId);

		return $this->toObject($array->result()[0]);
	}

	public function buscarOnde($key, $value)
	{
		$array = $this->DAO->buscarOnde(ArtefatoDAO::TABELA_ARTERFATO, array($key => $value));

		return $this->criarLista($array->result());
	}

	public function atualizar($artefato)
	{
		$this->DAO->atualizar(ArtefatoDAO::TABELA_ARTERFATO, $artefato->array());
	}


	public function deletar($artefato)
	{
		$this->DAO->deletar(ArtefatoDAO::TABELA_ARTERFATO, $artefato->array());
	}

	public function contar()
	{
		return $this->DAO->contar(TABELA_ARTERFATO);
	}

	public function contarDesativados()
	{
		return $this->DAO->contarDesativados(TABELA_ARTERFATO);
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

	public function array(): array
	{
		return array(
			'id' => isset($this->id) ? $this->id : null,
			'ordem' => $this->ordem,
			'nome' => $this->nome,
			'status' => $this->status,
		);
	}
}
