<?php

include_once('NivelDeAcesso.php');

class Escrever implements NivelDeAcesso
{
	const NIVEL = 4;
	const NOME = 'escrever';

	public function nome(): string
	{
		return Escrever::NOME;
	}


	public function nivel(): int
	{
		return Escrever::NIVEL;
	}
}
