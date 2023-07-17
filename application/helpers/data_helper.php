<?php

function data($data_string)
{
	include_once 'application/libraries/Data.php';
	$data = new Data($data_string);
	return $data->formatoDoBrasil();
}
