<?php

include_once('StatusDoAndamento.php');


class Conformado implements Status
{
	const NOME = 'conformado';
	const NIVEL = 4;

	public function nome(): string
	{
		return Conformado::NOME;
	}

	public function nivel(): int
	{
		return Conformado::NIVEL;
	}

}

?>
