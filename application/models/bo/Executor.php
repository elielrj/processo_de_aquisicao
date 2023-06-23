<?php

include_once('NivelDeAcesso.php');

class Executor implements NivelDeAcesso
{
	const NOME = 'executor';
	const NIVEL = 3;

	public function nome(): string
	{
		return Executor::NOME;
	}


	public function nivel(): int
	{
		return Executor::NIVEL;
	}
}
