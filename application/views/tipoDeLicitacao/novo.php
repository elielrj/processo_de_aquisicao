<?php
defined('BASEPATH') or exit('No direct script access allowed');

echo "<h1>{$titulo}</h1>" .

    form_open('TipoDeLicitacaoController/criar', array('class' => 'form-group')) .

    form_input(['name' => 'id', 'class' => 'form-control', 'type' => 'hidden']) . "</br>" .

    form_label('Nome') . form_input(['name' => 'nome', 'class' => 'form-control', 'maxlength' => 150]) . "</br>" .

    form_label('Lei') . form_input(['name' => 'lei', 'class' => 'form-control', 'maxlength' => 150]) . "</br>" .
   
    form_label('Artigo') . form_input(['name' => 'artigo', 'class' => 'form-control', 'maxlength' => 10]) . "</br>" .
   
    form_label('Inciso') . form_input(['name' => 'inciso', 'class' => 'form-control', 'maxlength' => 10]) . "</br>" .

    form_label('Data da Lei') . form_input(['name' => 'dataDaLei', 'type' => 'date', 'class' => 'form-control', 'maxlength' => 150]) . "</br>" .

    form_label('Página') . form_input(['name' => 'pagina', 'class' => 'form-control', 'maxlength' => 250]) . "</br>" .

    form_label('Status') . form_dropdown('status', [true => 'Ativo', false => 'Inativo'], true, ['class' => 'form-control']) . "</br>" .

    form_submit('enviar', 'Enviar', ['class' => 'btn btn-primary btn-lg btn-block']) .
    "<a href=" . base_url('index.php/TipoDeLicitacaoController') . " class='btn btn-danger btn-lg btn-block' >Cancelar</a>";

echo form_close();
?>