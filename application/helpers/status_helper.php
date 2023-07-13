<?php

function status($value)
{
	$color = $value ? 'green' : 'red';

	return "<p style='color:{$color}'>" .
		(
		$value
			? 'Ativo'
			: 'Inativo'
		) .
		"</p>";
}
