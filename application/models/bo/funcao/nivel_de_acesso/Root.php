<?php

require_once 'InterfaceNivelDeAcesso.php';

class Root implements InterfaceNivelDeAcesso
{
	const NOME = 'root';

	public function nome()
	{
		return self::$NOME;
	}
}
