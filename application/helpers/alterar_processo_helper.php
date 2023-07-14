<?php
function alterar_processo($id)
{
	$link = "index.php/" . PROCESSO_CONTROLLER . "/alterar/{$id}";

	return "<a href='" . base_url($link) . "'>Alterar</a>";
}
