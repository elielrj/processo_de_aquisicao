<?php
function alterar($controller, $id)
{
	$link = "index.php/{$controller}/alterar/{$id}";

	return "<a href='" . base_url($link) . "'>" . 'Aterar' . "</a>";
}
