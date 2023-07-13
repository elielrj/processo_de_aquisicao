<?php
function excluir($controller, $id)
{
	$link = "index.php/{$controller}/deletar/{$id}";

	return "<a href='" . base_url($link) . "'>" . 'Excluir' . "</a>";
}
