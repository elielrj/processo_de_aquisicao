<?php
defined('BASEPATH') or exit('No direct script access allowed');

include_once 'campos.php';

echo "<h1>{$titulo}</h1>";

echo form_open('UsuarioController/atualizarUsuario', $form_open);

echo form_input($form_input_id);

echo form_label($form_label_nome) . form_input($form_input_nome) . "</br>";

echo form_label($form_label_sobrenome) . form_input($form_input_sobrenome) . "</br>";

echo form_label($form_label_email) . form_input($form_input_email) . "</br>";

echo form_label($form_label_cpf) . form_input($form_input_cpf) . "</br>";

echo form_label($form_label_senha) . form_input($form_input_senha) . "</br>";

echo form_label($form_label_departamento) . form_dropdown('departamento_id', $departamentos, $form_dropdown_departamento_valor, $form_dropdown_departamento_formatacao) . "</br>";

echo form_label($form_label_status) . form_dropdown('status', [true => 'Ativo', false => 'Inativo'], $form_dropdown_status_valor, $form_dropdown_status_formatacao) . "</br>";

echo form_submit('enviar', 'Enviar', $form_submit_enviar) . "</br>";

echo "<a href=" . base_url('index.php/processos') . " {$form_submit_cancelar} >Cancelar</a>";

echo form_close();
?>