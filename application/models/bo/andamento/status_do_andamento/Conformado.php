<?php

require_once 'InterfaceStatusDoAndamento.php';


class Conformado implements InterfaceStatusDoAndamento
{
	const NOME = 'conformado';

	public function nome()
	{
		return self::$NOME;
	}
}

?>
