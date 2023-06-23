<?php


include_once('Status.php');


class Criado implements Status
{
	const NOME = 'criado';
	const NIVEL = 0;

	public function nome(): string
	{
		return Criado::NOME;
	}

	public function nivel(): int
	{
		return Criado::NIVEL;
	}
}
