<?php

interface InterfaceRetrive
{
	public function buscarPorId($objetoId);

	public function buscarTodosAtivos($inicio, $fim);

	public function buscarTodosInativos($inicio, $fim);

	public function buscarTodosStatus($inicio, $fim);

	public function buscarAonde($whare);

}
