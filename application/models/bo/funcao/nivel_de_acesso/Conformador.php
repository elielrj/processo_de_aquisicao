<?php

require_once 'InterfaceNivelDeAcesso.php';

class Conformador implements InterfaceNivelDeAcesso
{
	const NOME = 'conformador';

	public function nome()
	{
		return self::$NOME;
	}
}
