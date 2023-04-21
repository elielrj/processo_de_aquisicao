<?php defined('BASEPATH') or exit('No direct script access allowed');


echo "<h1>{$titulo}</h1>";

echo form_open_multipart(
    'ArquivoController/atualizar',
    array('class' => 'form-group')
);

echo form_input(
    array(
        'name' => 'id',
        'type' => 'hidden',
        'value' => $arquivo->id
    )
);

echo form_label('Nome');
echo form_input(
    array(
        'name' => 'nome',
        'class' => 'form-control',
        'maxlength' => 150,
        'value' => $arquivo->nome
    )
);

echo "</br>";


echo form_label('Path');
echo form_input(
    array(
        'name' => 'path',
        'class' => 'form-control',
        'maxlength' => 20,
        'value' => $arquivo->path
    )
);

echo "</br>";

echo form_label('Nome do Arquivo');
echo form_input(
    array(
        'name' => 'nome_do_arquivo',
        'class' => 'form-control',
        'maxlength' => 20,
        'value' => $arquivo->nomeDoArquivo
    )
);

echo "</br>";

echo form_label('Data de Upload');

$timezone = new DateTimeZone('America/Sao_Paulo');
$data_hora = new DateTime($arquivo->dataDoUpload, $timezone);

echo form_input(
    array(
        'name' => 'data_do_upload',
        'class' => 'form-control',
        'maxlength' => 20,
        'value' => $data_hora->format('d-m-Y H:m:s')
    )
);

echo "</br>";

echo form_label('Processo');

echo form_input(
    array(

        'class' => 'form-control',
        'maxlength' => 20,
        'value' => $arquivo->processo->objeto . ' (' . $arquivo->processo->nupNud . ')',
        'disabled' => 'disabled',
    )
);

echo form_input(
    array(
        'name' => 'processo_id',
        'class' => 'form-control',
        'maxlength' => 20,
        'value' => $arquivo->processo->id,
        'type' => 'hidden',
    )
);

echo "</br>";

echo form_label('Usuário');
echo form_input(
    array(

        'class' => 'form-control',
        'maxlength' => 20,
        'value' => $arquivo->usuario->email,
        'disabled' => 'disabled'
    )
);

echo form_input(
    array(
        'name' => 'usuario_id',
        'class' => 'form-control',
        'maxlength' => 20,
        'value' => $arquivo->usuario->id,
        'type' => 'hidden',
    )
);

echo "</br>";

echo form_label('Status');
echo form_input(
    array(
        'class' => 'form-control',
        'maxlength' => 20,
        'value' => ($arquivo->status ? 'Ativo' : 'Inativo'),
        'disabled' => 'disabled'
    )
);

echo form_input(
    array(
        'name' => 'status',
        'class' => 'form-control',
        'maxlength' => 20,
        'value' => $arquivo->status,
        'type' => 'hidden',
    )
);

echo "</br>";

echo form_submit(
    'enviar',
    'Enviar',
    array(
        'class' => 'btn btn-primary btn-lg btn-block'
    )
);
echo "<a href=" . base_url('index.php/arquivo') .
    " class='btn btn-danger btn-lg btn-block' >Cancelar</a>";

echo form_close();
?>