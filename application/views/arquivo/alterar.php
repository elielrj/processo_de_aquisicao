<?php
defined('BASEPATH') or exit('No direct script access allowed');

view_titulo($titulo);

view_form_open_multipart(ArquivoController::$arquivoController.'/atualizar');

view_input('', 'id', 'id', 'hidden', $arquivo->id);

view_dropdown('Artefato', 'artefato_id', $artefatos, $arquivo->artefatoId);

view_input('Path', 'path', 'path', 'text', $arquivo->path);

view_input('Nome do Arquivo', 'nome', 'nome', 'text', $arquivo->nome);

view_dropdown('Processo', 'processo_id', $processos, $arquivo->processoId);

view_dropdown_status($arquivo->status);

view_form_submit_enviar();

view_form_submit_cancelar('arquivo-listar');

form_close();
?>
