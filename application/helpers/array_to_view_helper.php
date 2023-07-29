<?php
function arrayToView(
	$titulo,
	$tabela,
	$pagina,
	$botoes)
{
	return [
		'titulo' => $titulo,
		'tabela' => $tabela,
		'pagina' => $pagina,
		'botoes' => $botoes,
	];
}
