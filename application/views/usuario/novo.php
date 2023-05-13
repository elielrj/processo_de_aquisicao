<?php

defined('BASEPATH') or exit('No direct script access allowed');

$form_open = ['class' => 'form-group'];

$form_label_id = 'id';
$form_label_nome = 'Nome';
$form_label_sobrenome = 'Sobrenome';
$form_label_email = 'Email';
$form_label_cpf = 'CPF';
$form_label_senha = 'Senha';
$form_label_departamento = 'Departamento';
$form_label_status = 'Status';

$form_input_nome = ['name' => 'nome', 'class' => 'form-control', 'type' => 'text', 'maxlength' => 150];
$form_input_sobrenome = ['name' => 'sobrenome', 'class' => 'form-control', 'type' => 'text', 'maxlength' => 150];
$form_input_email = ['name' => 'email', 'class' => 'form-control', 'type' => 'email', 'maxlength' => 150];
$form_input_cpf = ['name' => 'cpf', 'class' => 'form-control', 'maxlength' => 11];
$form_input_senha = ['name' => 'senha', 'class' => 'form-control', 'maxlength' => 6];

$form_submit_enviar = ['class' => 'btn btn-primary btn-lg btn-block'];
$form_submit_cancelar = "class='btn btn-danger btn-lg btn-block'";

echo "<h1>{$titulo}</h1>";

echo form_open('UsuarioController/criar', $form_open);


echo form_label($form_label_nome) . form_input($form_input_nome) . "</br>";

echo form_label($form_label_sobrenome) . form_input($form_input_sobrenome) . "</br>";

echo form_label($form_label_email) . form_input($form_input_email) . "</br>";

echo form_label($form_label_cpf) . form_input($form_input_cpf) . "</br>";

echo form_label($form_label_senha) . form_input($form_input_senha) . "</br>";

echo form_label($form_label_departamento) . form_dropdown('departamento_id', $departamentos, $form_dropdown_departamento_valor, ['class' => 'form-control']) . "</br>";

echo form_label($form_label_status) . form_dropdown('status', [true => 'Ativo', false => 'Inativo'], $form_dropdown_status_valor, ['class' => 'form-control']) . "</br>";

echo form_submit('enviar', 'Enviar', $form_submit_enviar) . "</br>";

echo "<a href=" . base_url('index.php/UsuarioController') . " {$form_submit_cancelar} >Cancelar</a>";

echo form_close();
?>