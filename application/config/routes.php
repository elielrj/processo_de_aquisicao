<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'LoginController';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;


$route['arquivo-listar'] = 'ArquivoController/listar';
$route['arquivo-atualizar'] = 'ArquivoController/atualizar';
$route['arquivo-deletar'] = 'ArquivoController/deletar';

//PROCESSO
$route['processo-listar'] = 'ProcessoController/listar';
$route['processo-listar-todos-completo'] = 'ProcessoController/listarTodosProcessosCompleto';
$route['processo-listar-todos-incompleto'] = 'ProcessoController/listarTodosProcessosIncompleto';
$route['processo-listar-por-sc'] = 'ProcessoController/listarPorSetorDemandante';
$route['processo-novo'] = 'ProcessoController/novo';

$route['artefato-listar'] = 'ArtefatoController/listar';
$route['artefato-novo'] = 'ArtefatoController/novo';

//ANDAMENTO
$route['andamento-listar'] = 'AndamentoController/listar';


//DEPARTAMENTO
$route['departamento-listar'] = 'DepartamentoController/listar';
$route['departamento-novo'] = 'DepartamentoController/novo';
$route['departamento-criar'] = 'DepartamentoController/criar';
$route['departamento-atualizar'] = 'DepartamentoController/atualizar';

//LEI
$route['lei-listar'] = 'LeiController/listar';
$route['lei-novo'] = 'LeiController/novo';

$route['tipo-listar'] = 'TipoController/listar';
$route['tipo-novo'] = 'TipoController/novo';
$route['tipo-alterar'] = 'TipoController/alterar';
$route['tipo-atualizar'] = 'TipoController/atualizar';

$route['ug-novo'] = 'UgController/novo';
$route['ug-listar'] = 'UgController/listar';

//USUÁRIO
$route['usuario-listar'] = 'UsuarioController/listar';
$route['usuario-novo'] = 'UsuarioController/novo';
$route['usuario-criar'] = 'UsuarioController/criar';
$route['usuario-atualizar'] = 'UsuarioController/atualizar';
$route['usuario-atualizar-usuario'] = 'UsuarioController/atualizarUsuario';
$route['usuario-alterar-usuario'] = 'UsuarioController/alterarUsuario';

$route['sair'] = 'LoginController/sair';
$route['modalidade-listar'] = 'ModalidadeController/listar';
$route['modalidade-novo'] = 'ModalidadeController/novo';

#lei-tipo-artefato
$route['lei-tipo-artefato-listar'] = 'LeiTipoArtefatoController/listar';
$route['lei-tipo-artefato-novo'] = 'LeiTipoArtefatoController/novo';
$route['lei-tipo-artefato-criar'] = 'LeiTipoArtefatoController/criar';

//SUGESTÃO
$route['sugestao-criar'] = 'SugestaoController/criar';





