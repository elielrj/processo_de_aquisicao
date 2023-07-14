<?php

function data_hora($data_Hora_string)
{
	include_once 'application/libraries/DataHora.php';
	$dataHora = new DataHora($data_Hora_string);
	return $dataHora->formatoDoBrasil();
}
