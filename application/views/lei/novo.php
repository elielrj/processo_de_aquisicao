<?php

defined('BASEPATH') or exit('No direct script access allowed');

echo "<h1>{$titulo}</h1>" .
 form_open('LeiController/criar', array('class' => 'form-group')) .
 form_label('Nome') . form_input(['name' => 'nome', 'class' => 'form-control', 'maxlength' => 250]) . "</br>" .
 form_label('Status') . form_dropdown('status', [true => 'Ativo', false => 'Inativo'], true, ['class' => 'form-control']) . "</br>" .
 form_submit('enviar', 'Enviar', ['class' => 'btn btn-primary btn-lg btn-block']) .
 "<a href=" . base_url('index.php/LeiController') . " class='btn btn-danger btn-lg btn-block' >Cancelar</a>";

echo form_close();
