<?php


include_once('Status.php');


class Executado implements Status
{
	const NOME = 'executado';
	const NIVEL = 3;

	public function nome(): string
	{
		return Executado::NOME;
	}

	public function nivel(): int
	{
		return Executado::NIVEL;
	}
}
