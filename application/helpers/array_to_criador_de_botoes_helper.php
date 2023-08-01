<?php

function array_to_criador_de_botoes_helper($controller,$quantidadeNoDB)
{
	return [
		'controller' => $controller,
		'quantidade_de_registros_no_banco_de_dados' => $quantidadeNoDB
	];
}
