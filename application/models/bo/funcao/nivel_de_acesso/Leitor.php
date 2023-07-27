<?php

require_once 'InterfaceNivelDeAcesso.php';

class Leitor implements InterfaceNivelDeAcesso
{
	const NOME = 'leitor';

	public function nome()
	{
		return self::$NOME;
	}
}

?>
