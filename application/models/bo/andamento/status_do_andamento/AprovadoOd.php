<?php

require_once 'InterfaceStatusDoAndamento.php';

class AprovadoOd implements InterfaceStatusDoAndamento
{
	const NOME = 'aprovado_od';

	public function nome()
	{
		return self::$NOME;
	}
}
