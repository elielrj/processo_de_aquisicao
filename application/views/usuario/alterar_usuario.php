<?php
defined('BASEPATH') or exit('No direct script access allowed');

view_titulo($titulo);

view_form_open('UsuarioController/atualizarUsuario');

view_input('Id','id','id','hidden',$usuario->id,150);
view_input('Nome','nome','nome','text',$usuario->nome,150);
view_input('Sobrenome','sobrenome','sobrenome','text',$usuario->sobrenome,250);
view_input('Email','email','email','text', $usuario->email,150);
view_input('CPF','cpf','cpf','text',$usuario->cpf,11);

view_input('Senha','senha','senha','password',$usuario->senha,6,'Caso não queira mudar a senha, deixe-a em branco!');

view_dropdown('Posto/Graduação','hierarquia_id',$hierarquias,$usuario->hierarquia->id);

//view_dropdown('Função','funcao_id',$funcoes,$usuario->funcao->id);

view_input('','funcao_id','','hidden',$usuario->funcao->id);

view_dropdown('Departamento', 'departamento_id', $departamentos, $_SESSION['departamento_id']);

view_input('', 'status', '', 'hidden', $value = $usuario->id);

view_form_submit_enviar();
view_form_submit_cancelar('processos');

echo form_close();
?>