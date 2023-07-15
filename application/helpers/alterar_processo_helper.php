<?php
function alterar_processo($id)
{
	$link = "index.php/" . PROCESSO_CONTROLLER . "/alterar/{$id}";

	return "<a href='" . base_url($link) . "'><img src='" . base_url('img/pencil-square.svg') . "' width='16' height='16'></a>";
}
