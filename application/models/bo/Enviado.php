<?php

include_once('StatusDoAndamento.php');

class Enviado implements StatusDoAndamento
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
