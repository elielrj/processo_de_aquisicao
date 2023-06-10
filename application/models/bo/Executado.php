<?php


include_once('StatusDoAndamento.php');


class Executado implements StatusDoAndamento
{
	const NOME = 'executado';
	const NIVEL = 2;

	public function nome(): string
	{
		return Executado::NOME;
	}

	public function nivel(): int
	{
		return Executado::NIVEL;
	}
}
