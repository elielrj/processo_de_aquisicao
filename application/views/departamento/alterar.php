<?php

defined('BASEPATH') or exit('No direct script access allowed');

view_titulo($titulo);

view_form_open('departamento-atualizar');

view_input('Id', 'id', 'id', 'hidden', $departamento->id);

view_input('Nome', 'nome', 'nome', 'text', $departamento->nome, 150);

view_input('Sigla', 'sigla', 'sigla', 'text', $departamento->sigla, 20);

view_dropdown_status($departamento->status);

view_dropdown('Ug','ug',$ugs,'');

view_form_submit_enviar();

view_form_submit_cancelar( 'departamento-listar');

echo form_close();
