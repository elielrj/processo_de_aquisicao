<?php

include_once('StatusDoAndamento.php');


class Arquivado implements StatusDoAndamento
{
	const NOME = 'arquivado';
	const NIVEL = 6;

	public function nome(): string
	{
		return Arquivado::NOME;
	}

	public function nivel(): int
	{
		return Arquivado::NIVEL;
	}

}

?>
