<?php

interface InterfaceDAO
{
	public function criar($objeto);

	public function atualizar($objeto);

	public function buscarPorId($objetoId);

	public function buscarTodosAtivos($inicio, $fim);

	public function buscarTodosInativos($inicio, $fim);

	public function buscarTodosStatus($inicio, $fim);

	public function buscarAonde($whare);

	public function excluirDeFormaPermanente($objetoId);

	public function excluirDeFormaLogica($objetoId);

	public function contarRegistrosAtivos();

	public function contarRegistrosInativos();

	public function contarTodosOsRegistros();

	public function criarLista($arrayList);

	public function toObject($linhaDoArrayList);

	public function toArray($objeto);

	public function options();
}
