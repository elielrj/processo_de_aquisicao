<?php

function arrayToCriadorDeBotoes($controller,$quantidadeNoDB)
{
	return [
		'controller' => $controller,
		'quantidade_de_registros_no_banco_de_dados' => $quantidadeNoDB
	];
}
