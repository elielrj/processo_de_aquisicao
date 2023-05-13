<?php
# FORM LABEL


# FORM OPEN


# FORM INPUT
$form_input_id = ['name' => 'id', 'class' => 'form-control', 'type' => 'hidden', 'value' => (isset($usuario->id) ? $usuario->id : '')];
$form_input_nome = ['name' => 'nome', 'class' => 'form-control', 'type' => 'text', 'maxlength' => 150, 'value' => (isset($usuario) ? $usuario->nome : '')];
$form_input_sobrenome = ['name' => 'sobrenome', 'class' => 'form-control', 'type' => 'text', 'maxlength' => 150, 'value' => (isset($usuario) ? $usuario->sobrenome : '')];
$form_input_email = ['name' => 'email', 'class' => 'form-control', 'type' => 'email', 'maxlength' => 150, 'value' => (isset($usuario) ? $usuario->email : '')];
$form_input_cpf = ['name' => 'cpf', 'class' => 'form-control', 'maxlength' => 11, 'value' => (isset($usuario) ? $usuario->cpf : '')];
$form_input_senha = ['name' => 'senha', 'class' => 'form-control', 'maxlength' => 6, 'value' => (isset($usuario) ? $usuario->senha : '')];

# FORM DROPDOWN
$form_dropdown_departamento_formatacao = ['class' => 'form-control'];
$form_dropdown_departamento_valor = (isset($usuario) ? $usuario->departamento->id : '');
$form_dropdown_status_formatacao = ['class' => 'form-control'];
$form_dropdown_status_valor = (isset($usuario) ? $usuario->status : true);

#FORM SUBMIT
$form_submit_enviar = ['class' => 'btn btn-primary btn-lg btn-block'];
$form_submit_cancelar = "class='btn btn-danger btn-lg btn-block'";

?>