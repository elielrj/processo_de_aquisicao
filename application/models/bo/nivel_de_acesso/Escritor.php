<?php

include_once('NivelDeAcesso.php');

class Escritor implements NivelDeAcesso
{
	const NOME = 'escritor';
	const NIVEL = 1;

	public function nome(): string
	{
		return Escritor::NOME;
	}


	public function nivel(): int
	{
		return Escritor::NIVEL;
	}
}
