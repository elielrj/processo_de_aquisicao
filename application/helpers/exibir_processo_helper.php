<?php
function exibir_processo($id)
{
	return "<a  href='" . base_url('index.php/' . PROCESSO_CONTROLLER . '/exibir/' . $id)
		. "'><i class='fa fa-eye' aria-hidden='true'></i></a>";
}
