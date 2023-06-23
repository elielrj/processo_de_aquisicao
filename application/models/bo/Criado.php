<?php


include_once('StatusDoAndamento.php');


class Criado implements StatusDoAndamento
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
