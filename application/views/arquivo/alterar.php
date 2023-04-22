<?php
defined('BASEPATH') or exit('No direct script access allowed');
$timezone = new DateTimeZone('America/Sao_Paulo');
$data_hora = new DateTime($arquivo->dataDoUpload, $timezone);

echo "<h1>{$titulo}</h1>" . "</br>" .

    form_open_multipart('ArquivoController/atualizar', ['class' => 'form-group']) . "</br>" .

    form_input(['name' => 'id', 'type' => 'hidden', 'value' => $arquivo->id]) . "</br>" .

    form_label('Nome') . form_input(['name' => 'nome', 'class' => 'form-control', 'maxlength' => 150, 'value' => $arquivo->nome]) . "</br>" .

    form_label('Path') . form_input(['name' => 'path', 'class' => 'form-control', 'maxlength' => 20, 'value' => $arquivo->path]) . "</br>" .

    form_label('Nome do Arquivo') . form_input(['name' => 'nome_do_arquivo', 'class' => 'form-control', 'maxlength' => 20, 'value' => $arquivo->nomeDoArquivo]) . "</br>" .

    form_label('Data de Upload') . form_input(['name' => 'data_do_upload', 'class' => 'form-control', 'maxlength' => 20, 'value' => $data_hora->format('d-m-Y H:m:s')]) . "</br>" .

    form_label('Processo') . form_dropdown('processo_id', $processos, $arquivo->processo->id, ['class' => 'form-control']) . "</br>" .

    form_label('Status') . form_dropdown('status', [true => 'Ativo', false => 'Inativo'], $arquivo->status, ['class' => 'form-control']) . "</br>" .

    form_submit('enviar', 'Enviar', ['class' => 'btn btn-primary btn-lg btn-block']) . "</br>" .

    "<a href=" . base_url('index.php/ArquivoController') . " class='btn btn-danger btn-lg btn-block' >Cancelar</a>";

form_close();
?>