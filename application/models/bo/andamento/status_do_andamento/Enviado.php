<?php

require_once 'InterfaceStatusDoAndamento.php';

class Enviado implements InterfaceStatusDoAndamento
{
	const NOME = 'enviado';

	public function nome()
	{
		return self::$NOME;
	}
}
