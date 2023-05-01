<?php

defined('BASEPATH') or exit('No direct script access allowed');

echo "<h1>{$titulo}</h1>" .
 form_open('UsuarioController/criar', ['class' => 'form-group']) .
 form_label('Email') . form_input(['name' => 'email', 'class' => 'form-control', 'type' => 'email', 'maxlength' => 150]) . "</br>" .
 form_label('CPF') . form_input(['name' => 'cpf', 'class' => 'form-control', 'maxlength' => 11]) . "</br>" .
 form_label('Senha') . form_input(['name' => 'senha', 'class' => 'form-control', 'maxlength' => 6]) . "</br>" .
 form_label('Departamento') . form_dropdown('departamento_id', $departamentos, '', ['class' => 'form-control']) . "</br>" .
 form_label('Status') . form_dropdown('status', [true => 'Ativo', false => 'Inativo'], true, ['class' => 'form-control']) . "</br>" .
 form_submit('enviar', 'Enviar', ['class' => 'btn btn-primary btn-lg btn-block']) . "</br>" .
 "<a href=" . base_url('index.php/UsuarioController') . " class='btn btn-danger btn-lg btn-block' >Cancelar</a>" .
 form_close();
?>