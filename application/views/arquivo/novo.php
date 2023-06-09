<?php

defined('BASEPATH') or exit('No direct script access allowed');

echo "<h1>{$titulo}</h1>";

echo form_open_multipart('ArquivoController/criar', ['class' => 'form-group']) .
 form_input(['name' => 'id', 'type' => 'hidden']) . "</br>" .
 form_label('Artefato') . form_dropdown('artefato_id', $artefatos, '', ['class' => 'form-control', 'maxlength' => 150]) . "</br>" .
 form_dropdown('processo_id', $processos, '', ['class' => 'form-control', 'id' => 'processo_id']) . "</br>" .
 form_input(['name' => 'arquivo_path', 'type' => 'hidden', 'value' => $arquivo->path]) .
 form_input(['name' => 'arquivo', 'class' => 'form-label form-control', 'type' => 'file']) . "</br>" .
 form_label('Status') . form_dropdown('arquivo_status', [true => 'Ativo', false => 'Inativo'], true, ['class' => 'form-control']) . "</br>" .
 form_submit('enviar', 'Enviar', ['class' => 'btn btn-primary btn-lg btn-block']) .
 "<a href=" . base_url('index.php/ArquivoController') . " class='btn btn-danger btn-lg btn-block' >Cancelar</a>" .
 form_close();

