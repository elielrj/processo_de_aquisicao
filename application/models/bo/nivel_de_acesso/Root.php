<?php

include_once('NivelDeAcesso.php');

class Root implements NivelDeAcesso
{
	const NOME = 'root';
	const NIVEL = 7;

	public function nome()
	{
		return Root::NOME;
	}

	public function nivel()
	{
		return Root::NIVEL;
	}
}
