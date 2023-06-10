<?php

include_once('NivelDeAcesso.php');

class Root implements NivelDeAcesso
{
	const NIVEL = 4;
	const NOME = 'root';

	public function nome(): string
	{
		return Root::NOME;
	}

	public function nivel(): int
	{
		return Root::NIVEL;
	}
}
