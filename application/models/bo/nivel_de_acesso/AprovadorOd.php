<?php

include_once('NivelDeAcesso.php');

class AprovadorOd implements NivelDeAcesso
{
	const NOME = 'aprovador_od';
	const NIVEL = 3;

	public function nome(): string
	{
		return AprovadorOd::NOME;
	}


	public function nivel(): int
	{
		return AprovadorOd::NIVEL;
	}
}
