<?php
defined('BASEPATH') or exit('No direct script access allowed');


echo "<h1>{$titulo}</h1>" . "</br>" .
   
    form_open('UsuarioController/atualizar', ['class' => 'form-group']) . "</br>" .

    form_input(['name' => 'id', 'class' => 'form-control', 'type' => 'hidden', 'value' => $usuario->id]) . "</br>" .

    form_label('Email') . form_input(['name' => 'email', 'class' => 'form-control', 'type' => 'email', 'maxlength' => 150, 'value' => $usuario->email]) . "</br>" .

    form_label('CPF') . form_input(['name' => 'cpf', 'class' => 'form-control', 'maxlength' => 11,'value' => $usuario->cpf]) . "</br>" .

    form_label('Senha') . form_input(['name' => 'senha', 'class' => 'form-control', 'maxlength' => 6, 'value' => $usuario->senha]) . "</br>" .

    form_label('Departamento') . form_dropdown('departamento_id', $departamentos, $usuario->departamento->id, ['class' => 'form-control']) . "</br>" .

    form_label('Status') . form_dropdown('status', [true => 'Ativo', false => 'Inativo'], $usuario->status, ['class' => 'form-control']) . "</br>" .

    form_submit('enviar', 'Enviar', ['class' => 'btn btn-primary btn-lg btn-block']) . "</br>" .

    "<a href=" . base_url('index.php/UsuarioController') . " class='btn btn-danger btn-lg btn-block' >Cancelar</a>" . "</br>" .

    form_close();
?>