<?php

require_once 'InterfaceNivelDeAcesso.php';

class Administrador implements InterfaceNivelDeAcesso
{
	const NOME = 'administrador';

	public function nome()
	{
		return self::$NOME;
	}
}

?>
