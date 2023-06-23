<?php


include_once('Status.php');


class Criado implements Status
{
	const NOME = 'criado';
	const NIVEL = 0;

	public function nome(): string
	{
		return Executado::NOME;
	}

	public function nivel(): int
	{
		return Executado::NIVEL;
	}
}
