<?php

function processo_completo($value)
{
	$color = $value ? 'green' : 'red';

	return "<p style='color:{$color}'>" .
		(
		$value
			? 'Completo'
			: 'Incompleto'
		) .
		"</p>";
}
