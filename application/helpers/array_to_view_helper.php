<?php
function array_to_view_helper(
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
