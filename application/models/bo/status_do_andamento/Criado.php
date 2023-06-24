<?php


include_once('StatusDoAndamento.php');


class Criado implements StatusDoAndamento
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
