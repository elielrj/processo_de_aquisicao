<?php
defined('BASEPATH') or exit('No direct script access allowed');

view_titulo($titulo);

view_form_open('departamento-criar');

view_input('Nome', 'nome', 'nome', 'text', '', 150);

view_input('Sigla', 'sigla', 'sigla', 'text', '', 20);

view_dropdown('Ug','ug',$ugs,'');

view_form_submit_enviar();

view_form_submit_cancelar( 'departamento-listar');

echo form_close();
