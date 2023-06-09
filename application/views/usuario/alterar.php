<?php
defined('BASEPATH') or exit('No direct script access allowed');

view_titulo($titulo);

view_form_open('usuario-atualizar');

view_input('Id','id','id','hidden',$usuario->id,150);
view_input('Nome de Guerra','nome_de_guerra','nome_de_guerra','text',$usuario->nomeDeGuerra,150);
view_input('Nome Completo','nome_completo','nome_completo','text',$usuario->nomeCompleto,250);
view_input('Email','email','email','text', $usuario->email,150);
view_input('CPF','cpf','cpf','text',$usuario->cpf,11);
view_input('Senha','senha','senha','password',$usuario->senha,6,'Caso não queira mudar a senha, deixe-a em branco!');

view_dropdown('Posto ou Graduação','hierarquia_id',$hierarquias,$usuario->hierarquia->id);
view_dropdown('Função','funcao_id',$funcoes,$usuario->funcao->id);
view_dropdown('Seção','departamento_id',$departamentos,$usuario->departamento->id);

view_dropdown_status();

view_form_submit_enviar();
view_form_submit_cancelar('UsuarioController');

echo form_close();
?>
