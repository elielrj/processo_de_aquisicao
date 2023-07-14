<?php
function excluir_processo($processo)
{
	include_once('application/models/bo/nivel_de_acesso/Executor.php');
	include_once('application/models/bo/nivel_de_acesso/Root.php');

	if(
		$_SESSION[FUNCAO_NIVEL_DE_ACESSO] === Executor::NOME ||
		$_SESSION[FUNCAO_NIVEL_DE_ACESSO] === Root::NOME
	)
	{
		if($processo->status)
		{
			return "<a  href='" .
				base_url('index.php/ProcessoController/excluir/' . $processo->id)
		. "'><i class='fa fa-trash' aria-hidden='true'></i></a>";

		}else{
			return "<a  href='" .
				base_url('index.php/ProcessoController/recuperar/' . $processo->id)
				. "'><i class='fa fa-undo' aria-hidden='true'></i></a>";
		}

	}else{
		return '-';
	}
}
