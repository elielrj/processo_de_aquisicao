<?php

function processo_historico($processo)
{
	$color = $processo->completo ? 'green' : 'red';

	$href = base_url('index.php/AndamentoController/listarPorProcesso/' . $processo->id);

	return "<a href='{$href}' style='color:{$color}'> <i class='fa fa-history' aria-hidden='true'</i></a>";
}
