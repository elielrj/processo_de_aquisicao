<?php

include_once('NivelDeAcesso.php');

class Aprovado implements NivelDeAcesso
{
	const NOME = 'aprovado';
	const NIVEL = 2;

	public function nome()
	{
		return Aprovado::NOME;
	}


	public function nivel()
	{
		return Aprovado::NIVEL;
	}
}
