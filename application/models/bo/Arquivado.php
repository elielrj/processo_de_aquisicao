<?php

include_once('Status.php');


class Arquivado implements Status
{
	const NOME = 'arquivado';
	const NIVEL = 5;

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
