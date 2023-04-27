<?php
defined('BASEPATH') or exit('No direct script access allowed');

echo "<h1>{$titulo}</h1>";

echo form_open('ProcessoController/atualizar', ['class' => 'form-group']) .

    form_input(['name' => 'id', 'type' => 'hidden', 'value' => $processo->id]) . "</br>" .

    form_label('Objeto do Processo') . form_input(['name' => 'objeto', 'class' => 'form-control', 'maxlength' => 250, 'value' => $processo->objeto]) . "</br>" .

    form_label('Nup/Nud') . form_input(['name' => 'nup_nud', 'class' => 'form-control', 'maxlength' => 20, 'value' => $processo->nupNud]) . "</br>" .

    form_label('Data do Processo') . form_input(['name' => 'data_do_processo', 'class' => 'form-control daterange', 'type' => 'date', 'value' => (new DateTime($processo->dataDoProcesso))->format('d-m-Y')]) . "</br>" . 

    form_label('Chave de Acesso') . form_input(['name' => 'chave_de_acesso', 'class' => 'form-control', 'value' => $processo->chaveDeAcesso]) . "</br>" .

    form_label('Seção') . form_dropdown('departamento_id', $departamentos, $processo->departamento->id, ['class' => 'form-control']) . "</br>" .

    form_label('Tipo de Licitação') . form_dropdown('tipoDeLicitacaoId', $tiposDeLicitacoes, $processo->tipoDeLicitacao->id,[ 'class' => 'form-control']) . "</br>" .

    form_label('Status') . form_dropdown('status', [true => 'Ativo', false => 'Inativo'], $processo->status, ['class' => 'form-control']) . "</br>" .

    form_submit('enviar', 'Enviar', ['class' => 'btn btn-primary btn-lg btn-block']);

"<a href=" . base_url('index.php/ProcessoController') . " class='btn btn-danger btn-lg btn-block' >Cancelar</a>";

form_close();
?>