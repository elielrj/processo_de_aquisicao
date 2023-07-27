<?php

require_once 'InterfaceNivelDeAcesso.php';

class Escritor implements InterfaceNivelDeAcesso
{
	const NOME = 'escritor';
	const NIVEL = 1;

	public function nome()
	{
		return self::$NOME;
	}
}
