<?php
defined('BASEPATH') or exit('No direct script access allowed');

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


/**
 * @class AndamentoController
 */
$route['andamento-listar'] = 'AndamentoController/listar';


/**
 * @class ArquivoController
 */
$route['arquivo-listar'] = 'ArquivoController/listar';
$route['arquivo-atualizar'] = 'ArquivoController/atualizar';
$route['arquivo-deletar'] = 'ArquivoController/deletar';


/**
 * @class ArtefatoController
 */
$route['artefato-listar'] = 'ArtefatoController/listar';
$route['artefato-novo'] = 'ArtefatoController/novo';


/**
 * @class DepartamentoController
 */
$route['departamento-listar'] = 'DepartamentoController/listar';
$route['departamento-novo'] = 'DepartamentoController/novo';
$route['departamento-criar'] = 'DepartamentoController/criar';
$route['departamento-atualizar'] = 'DepartamentoController/atualizar';


/**
 * @class LeiController
 */
$route['lei-listar'] = 'LeiController/listar';
$route['lei-novo'] = 'LeiController/novo';


/**
 * @class LeiController
 */
$route['lei-tipo-artefato-listar'] = LEI_TIPO_ARTEFATO_CONTROLLER . '/listar';
$route['lei-tipo-artefato-novo'] = LEI_TIPO_ARTEFATO_CONTROLLER . '/novo';
$route['lei-tipo-artefato-criar'] = LEI_TIPO_ARTEFATO_CONTROLLER . '/criar';


/**
 * @class TipoController
 */
$route['tipo-listar'] = 'TipoController/listar';
$route['tipo-novo'] = 'TipoController/novo';
$route['tipo-alterar'] = 'TipoController/alterar';
$route['tipo-atualizar'] = 'TipoController/atualizar';


/**
 * @class UgController
 */
$route['ug-novo'] = 'UgController/novo';
$route['ug-listar'] = 'UgController/listar';


/**
 * @class LoginController
 */
$route['sair'] = 'LoginController/sair';


/**
 * @class ModalidadeController
 */
$route['modalidade-listar'] = 'ModalidadeController/listar';
$route['modalidade-novo'] = 'ModalidadeController/novo';


/**
 * @class ProcessoController
 */
$route['processo-listar'] = 'ProcessoController/listar';
$route['processo-listar-todos-completo'] = 'ProcessoController/listarTodosProcessosCompleto';
$route['processo-listar-todos-incompleto'] = 'ProcessoController/listarTodosProcessosIncompleto';
$route['processo-listar-excluidos'] = 'ProcessoController/listarTodosExcluidos';
$route['processo-listar-por-sc'] = 'ProcessoController/listarPorSetorDemandante';
$route['processo-novo'] = 'ProcessoController/novo';
$route['processo-listar-almox'] = 'ProcessoController/listarPorSetorDemandanteAlmox';
$route['processo-listar-aprov'] = 'ProcessoController/listarPorSetorDemandanteAprov';
$route['processo-listar-saude'] = 'ProcessoController/listarPorSetorDemandanteSaude';
$route['processo-listar-informatica'] = 'ProcessoController/listarPorSetorDemandanteInformatica';
$route['processo-listar-transporte'] = 'ProcessoController/listarPorSetorDemandanteMntTransp';
$route['processo-listar-salc'] = 'ProcessoController/listarPorSetorDemandanteSalc';


/**
 * @class SugestaoController
 */
$route['sugestao-criar'] = 'SugestaoController/criar';
$route['sugestao-listar'] = 'SugestaoController/listar';
$route['sugestao-novo'] = 'SugestaoController/novo';


/**
 * @class UsuarioController
 */
$route['usuario-listar'] = 'UsuarioController/listar';
$route['usuario-novo'] = 'UsuarioController/novo';
$route['usuario-criar'] = 'UsuarioController/criar';
$route['usuario-atualizar'] = 'UsuarioController/atualizar';
$route['usuario-atualizar-usuario'] = 'UsuarioController/atualizarUsuario';
$route['usuario-alterar-usuario'] = 'UsuarioController/alterarUsuario';



