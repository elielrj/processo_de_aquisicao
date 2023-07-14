<?php
function andamento_processo($processo)
{
	$andamento = $processo->listaDeAndamento[0]->nome();

	$andamento = replace_od($andamento);
	$andamento = replace_fisc_adm($andamento);
	$andamento = ucfirst($andamento);

	$href = base_url('index.php/AndamentoController/listarPorProcesso/' . $processo->id);

	return "<a  href='" . $href . "'>{$andamento}</a>";

}
