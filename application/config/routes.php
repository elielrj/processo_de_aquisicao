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


/**
 * @class ArquivoController
 */
$route['arquivo-listar'] = ARQUIVO_CONTROLLER . '/listar';
$route['arquivo-atualizar'] = ARQUIVO_CONTROLLER . '/atualizar';
$route['arquivo-deletar'] = ARQUIVO_CONTROLLER . '/deletar';


/**
 * @class ArtefatoController
 */
$route['artefato-listar'] = ARTEFATO_CONTROLLER . '/listar';
$route['artefato-novo'] = ARTEFATO_CONTROLLER . '/novo';


/**
 * @class DepartamentoController
 */
$route['departamento-listar'] = DEPARTAMENTO_CONTROLLER . '/listar';
$route['departamento-novo'] = DEPARTAMENTO_CONTROLLER . '/novo';
$route['departamento-criar'] = DEPARTAMENTO_CONTROLLER . '/criar';
$route['departamento-atualizar'] = DEPARTAMENTO_CONTROLLER . '/atualizar';


/**
 * @class LeiController
 */
$route['lei-listar'] = LEI_CONTROLLER . '/listar';
$route['lei-novo'] = LEI_CONTROLLER . '/novo';


/**
 * @class LeiController
 */
$route['lei-tipo-artefato-listar'] = LEI_TIPO_ARTEFATO_CONTROLLER . '/listar';
$route['lei-tipo-artefato-novo'] = LEI_TIPO_ARTEFATO_CONTROLLER . '/novo';
$route['lei-tipo-artefato-criar'] = LEI_TIPO_ARTEFATO_CONTROLLER . '/criar';


/**
 * @class TipoController
 */
$route['tipo-listar'] = TIPO_CONTROLLER . '/listar';
$route['tipo-novo'] = TIPO_CONTROLLER . '/novo';
$route['tipo-alterar'] = TIPO_CONTROLLER . '/alterar';
$route['tipo-atualizar'] = TIPO_CONTROLLER . '/atualizar';


/**
 * @class UgController
 */
$route['ug-novo'] = UG_CONTROLLER . '/novo';
$route['ug-listar'] = UG_CONTROLLER . '/listar';


/**
 * @class LoginController
 */
$route['sair'] = LOGIN_CONTROLLER . '/sair';


/**
 * @class ModalidadeController
 */
$route['modalidade-listar'] = MODALIDADE_CONTROLLER . '/listar';
$route['modalidade-novo'] = MODALIDADE_CONTROLLER . '/novo';


/**
 * @class ProcessoController
 */
$route['processo-listar'] = PROCESSO_CONTROLLER . '/listar';
$route['processo-listar-todos-completo'] = PROCESSO_CONTROLLER . '/listarTodosProcessosCompleto';
$route['processo-listar-todos-incompleto'] = PROCESSO_CONTROLLER . '/listarTodosProcessosIncompleto';
$route['processo-listar-excluidos'] = PROCESSO_CONTROLLER . '/listarTodosExcluidos';
$route['processo-listar-por-sc'] = PROCESSO_CONTROLLER . '/listarPorSetorDemandante';
$route['processo-novo'] = PROCESSO_CONTROLLER . '/novo';
$route['processo-listar-almox'] = PROCESSO_CONTROLLER . '/listarPorSetorDemandanteAlmox';
$route['processo-listar-aprov'] = PROCESSO_CONTROLLER . '/listarPorSetorDemandanteAprov';
$route['processo-listar-saude'] = PROCESSO_CONTROLLER . '/listarPorSetorDemandanteSaude';
$route['processo-listar-informatica'] = PROCESSO_CONTROLLER . '/listarPorSetorDemandanteInformatica';
$route['processo-listar-transporte'] = PROCESSO_CONTROLLER . '/listarPorSetorDemandanteMntTransp';
$route['processo-listar-salc'] = PROCESSO_CONTROLLER . '/listarPorSetorDemandanteSalc';


/**
 * @class SugestaoController
 */
$route['sugestao-criar'] = SUGESTAO_CONTROLLER . '/criar';


/**
 * @class UsuarioController
 */
$route['usuario-listar'] = USUARIO_CONTROLLER . '/listar';
$route['usuario-novo'] = USUARIO_CONTROLLER . '/novo';
$route['usuario-criar'] = USUARIO_CONTROLLER . '/criar';
$route['usuario-atualizar'] = USUARIO_CONTROLLER . '/atualizar';
$route['usuario-atualizar-usuario'] = USUARIO_CONTROLLER . '/atualizarUsuario';
$route['usuario-alterar-usuario'] = USUARIO_CONTROLLER . '/alterarUsuario';



