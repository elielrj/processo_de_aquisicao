<?php
defined('BASEPATH') or exit('No direct script access allowed');

echo "<h1>{$titulo}</h1>" .

    form_open('ProcessoController/criar', ['class' => 'form-group']) .

    form_input(['name' => 'id', 'type' => 'hidden']) . "</br>" .

    form_label('Objeto do processo') . form_input(['name' => 'objeto', 'class' => 'form-control', 'maxlength' => 250]) . "</br>" .

    form_label('Numero') . form_input(['name' => 'numero', 'class' => 'form-control', 'maxlength' => 20]) . "</br>" .

    form_label('Data do Processo') . form_input(['name' => 'data', 'class' => 'form-control daterange', 'type' => 'date', 'value' => (new DateTime('now', new DateTimeZone('America/Sao_Paulo')))->format('d-m-Y')]) . "</br>" .

    form_label('Chave de Acesso') . form_input(['name' => 'chave', 'class' => 'form-control', 'value' => uniqid()]) . "</br>" .

    form_label('Seção') . form_dropdown('departamento_id', $departamentos, $departamento,[ 'class' => 'form-control']) . "</br>" .
    
    form_label('Modalidade') . form_dropdown('modalidade_id', $modalidades, '',[ 'class' => 'form-control']) . "</br>" .

    form_label('Status') . form_dropdown('status', [true => 'Ativo', false => 'Inativo'], true, ['class' => 'form-control']) . "</br>" .

    form_submit('enviar', 'Enviar', array('class' => 'btn btn-primary btn-lg btn-block')) . "</br>" .
    "<a href=" . base_url('index.php/ProcessoController') . " class='btn btn-danger btn-lg btn-block' >Cancelar</a>" .

    form_close();
?>