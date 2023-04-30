<?php

defined('BASEPATH') or exit('No direct script access allowed');

echo "<h1>{$titulo}</h1>" . "</br>" .
 form_open('ArtefatoController/atualizar', array('class' => 'form-group')) .
 form_input(['name' => 'id', 'class' => 'form-control', 'type' => 'hidden', 'value' => $artefato->id]) . "</br>" .
 form_label('Nome') . form_input(['name' => 'nome', 'class' => 'form-control', 'maxlength' => 250, 'value' => $artefato->nome]) . "</br>" .
 form_label('Status') . form_dropdown('status', [true => 'Ativo', false => 'Inativo'], $artefato->status, ['class' => 'form-control']) . "</br>" .
 form_submit('enviar', 'Enviar', ['class' => 'btn btn-primary btn-lg btn-block']) . "</br>" .
 "<a href=" . base_url('index.php/ArtefatoController') . " class='btn btn-danger btn-lg btn-block'>Cancelar</a>" .
 form_close();
