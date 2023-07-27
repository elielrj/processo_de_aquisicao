<?php

require_once 'InterfaceStatusDoAndamento.php';

class AprovadoFiscAdm implements InterfaceStatusDoAndamento
{
	const NOME = 'aprovado_fisc_adm';

	public function nome()
	{
		return self::$NOME;
	}
}
