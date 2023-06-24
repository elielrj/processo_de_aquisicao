<?php

include_once('StatusDoAndamento.php');

class AprovadoOd implements StatusDoAndamento
{
	const NOME = 'aprovado_od';
	const NIVEL = 3;

	public function nome()
	{
		return AprovadoOd::NOME;
	}


	public function nivel()
	{
		return AprovadoOd::NIVEL;
	}
}
