<?php

require_once 'InterfaceStatusDoAndamento.php';

class Criado implements InterfaceStatusDoAndamento
{
	const NOME = 'criado';

	public function nome()
	{
		return self::$NOME;
	}
}
