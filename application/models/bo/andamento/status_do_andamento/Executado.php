<?php

require_once 'InterfaceStatusDoAndamento.php';

class Executado implements InterfaceStatusDoAndamento
{
	const NOME = 'executado';

	public function nome()
	{
		return self::$NOME;
	}
}
