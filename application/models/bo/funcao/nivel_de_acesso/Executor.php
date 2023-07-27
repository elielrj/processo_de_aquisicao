<?php

require_once 'InterfaceNivelDeAcesso.php';

class Executor implements InterfaceNivelDeAcesso
{
	const NOME = 'executor';

	public function nome()
	{
		return self::$NOME;
	}

}
