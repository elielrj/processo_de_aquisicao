<?php

defined('BASEPATH') or exit('No direct script access allowed');

view_titulo($titulo);

view_form_open('usuario-criar');

view_input('Nome','nome','nome','text','',150);
view_input('Sobrenome','sobrenome','sobrenome','text','',250);
view_input('Email','email','email','text','',150);
view_input('CPF','cpf','cpf','text','',11);
view_input('Senha','senha','senha','password','',6);

view_dropdown('Posto ou Graduação','hierarquia_id',$hierarquias,'');
view_dropdown('Função','funcao_id',$funcoes,'');
view_dropdown('Seção','departamento_id',$departamentos,'');

view_dropdown_status();

view_form_submit_enviar();
view_form_submit_cancelar(UsuarioController::$usuarioController);

echo form_close();
