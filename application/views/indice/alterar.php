<?php
defined('BASEPATH') or exit('No direct script access allowed');

echo "<h1>{$titulo}</h1>" . "</br>" .

    form_open('IndiceController/atualizar', array('class' => 'form-group')) .

    form_input(['name' => 'id', 'type' => 'hidden', 'value' => $indice->id]) .

    form_label('Tipo de Licitação') . form_dropdown('tipo_de_licitacao_id', $tiposDeLicitacao,$indice->id,['class' => 'form-control']) . "</br>" .

    form_label('Status') . form_dropdown('status', [true => 'Ativo', false => 'Inativo'], $indice->status, ['class' => 'form-control']) . "</br>" .

    form_submit('enviar', 'Enviar', ['class' => 'btn btn-primary btn-lg btn-block']) . "</br>" .

    "<a href=" . base_url('index.php/IndiceController') . " class='btn btn-danger btn-lg btn-block'>Cancelar</a>" .

    form_close();

?>