<?php

include_once('NivelDeAcesso.php');

class AprovadorFiscAdm implements NivelDeAcesso
{
	const NOME = 'aprovador_fisc_adm';
	const NIVEL = 2;

	public function nome(): string
	{
		return AprovadorFiscAdm::NOME;
	}


	public function nivel(): int
	{
		return AprovadorFiscAdm::NIVEL;
	}
}
