<?php

include_once('NivelDeAcesso.php');

class Conformador implements NivelDeAcesso
{
	const NOME = 'conformador';
	const NIVEL = 4;

	public function nome(): string
	{
		return Conformador::NOME;
	}


	public function nivel(): int
	{
		return Conformador::NIVEL;
	}
}
