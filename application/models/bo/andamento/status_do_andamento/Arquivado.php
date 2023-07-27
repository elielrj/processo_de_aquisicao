<?php

require_once 'InterfaceStatusDoAndamento.php';

class Arquivado implements InterfaceStatusDoAndamento
{
	const NOME = 'arquivado';

	public function nome()
	{
		return self::$NOME;
	}
}

?>
