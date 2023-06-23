<?php

include_once('NivelDeAcesso.php');

class Aprovador implements NivelDeAcesso
{
	const NOME = 'aprovador';
	const NIVEL = 2;

	public function nome(): string
	{
		return Aprovador::NOME;
	}


	public function nivel(): int
	{
		return Aprovador::NIVEL;
	}
}
