<?php

include_once('Status.php');

class Enviado implements Status
{
	const NOME = 'enviado';
	const NIVEL = 1;

	public function nome(): string
	{
		return Enviado::NOME;
	}

	public function nivel(): int
	{
		return Enviado::NIVEL;
	}
}
