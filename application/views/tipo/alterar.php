<?php
defined('BASEPATH') or exit('No direct script access allowed');

view_titulo($titulo);

view_form_open_multipart('TipoController/atualizar');

view_input('', 'id', 'id', 'hidden', $tipo->id);

view_input('Nome', 'nome', 'nome', 'text', $tipo->nome);

view_dropdown_status($tipo->status);

view_form_submit_enviar();

view_form_submit_cancelar('tipo-listar');

form_close();
?>
