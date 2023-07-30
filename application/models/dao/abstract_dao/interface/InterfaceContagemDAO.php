<?php

interface InterfaceContagemDAO
{
	public function contarRegistrosAtivos();

	public function contarRegistrosInativos();

	public function contarTodosOsRegistros();
	public function contarTodosOsRegistrosAonde($where);
}
