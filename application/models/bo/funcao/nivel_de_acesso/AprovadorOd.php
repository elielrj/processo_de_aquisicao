<?php

require_once 'InterfaceNivelDeAcesso.php';

class AprovadorOd implements InterfaceNivelDeAcesso
{
	const NOME = 'aprovador_od';

	public function nome()
	{
		return self::$NOME;
	}
}
