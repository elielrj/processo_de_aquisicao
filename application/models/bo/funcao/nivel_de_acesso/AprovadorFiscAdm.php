<?php

require_once 'InterfaceNivelDeAcesso.php';

class AprovadorFiscAdm implements InterfaceNivelDeAcesso
{
	const NOME = 'aprovador_fisc_adm';

	public function nome()
	{
		return self::$NOME;
	}
}
