<?php

include_once('StatusDoAndamento.php');

class AprovadoFiscAdm implements StatusDoAndamento
{
	const NOME = 'aprovado_fisc_adm';
	const NIVEL = 2;

	public function nome()
	{
		return AprovadoFiscAdm::NOME;
	}


	public function nivel()
	{
		return AprovadoFiscAdm::NIVEL;
	}
}
