<?php

interface InterfaceRetriveController
{
	public function buscarPorId($id);

	public function buscarTodosAtivos($inicio, $fim);

	public function buscarTodosInativos($inicio, $fim);

	public function buscarTodosStatus($inicio, $fim);

	public function buscarAonde($where);

	public function buscarAondeComInicioEFim($whare,$inicio, $fim);
}
