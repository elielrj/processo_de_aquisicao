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

require_once 'application/controllers/*.php';

/**
 * @class AndamentoController
 */


/**
 * @class ArquivoController
 */
$route['arquivo-listar'] = ArquivoController::ARQUIVO_CONTROLLER . '/listar';
$route['arquivo-atualizar'] = ArquivoController::ARQUIVO_CONTROLLER . '/atualizar';
$route['arquivo-deletar'] = ArquivoController::ARQUIVO_CONTROLLER . '/deletar';


/**
 * @class ArtefatoController
 */
$route['artefato-listar'] = ArtefatoController::ARTEFATO_CONTROLLER . '/listar';
$route['artefato-novo'] = ArtefatoController::ARTEFATO_CONTROLLER . '/novo';


/**
 * @class DepartamentoController
 */

$route['departamento-listar'] = DepartamentoController::DEPARTAMENTO_CONTROLLER . '/listar';
$route['departamento-novo'] = DepartamentoController::DEPARTAMENTO_CONTROLLER . '/novo';
$route['departamento-criar'] = DepartamentoController::DEPARTAMENTO_CONTROLLER . '/criar';
$route['departamento-atualizar'] = DepartamentoController::DEPARTAMENTO_CONTROLLER . '/atualizar';


/**
 * @class LeiController
 */

$route['lei-listar'] = LeiController::LEI_CONTROLLER . '/listar';
$route['lei-novo'] = LeiController::LEI_CONTROLLER . '/novo';


/**
 * @class LeiController
 */

$route['lei-tipo-artefato-listar'] = LeiTipoArtefatoController::LEI_TIPO_ARTEFATO_CONTROLLER . '/listar';
$route['lei-tipo-artefato-novo'] = LeiTipoArtefatoController::LEI_TIPO_ARTEFATO_CONTROLLER . '/novo';
$route['lei-tipo-artefato-criar'] = LeiTipoArtefatoController::LEI_TIPO_ARTEFATO_CONTROLLER . '/criar';


/**
 * @class TipoController
 */

$route['tipo-listar'] = TipoController::TIPO_CONTROLLER . '/listar';
$route['tipo-novo'] = TipoController::TIPO_CONTROLLER . '/novo';
$route['tipo-alterar'] = TipoController::TIPO_CONTROLLER . '/alterar';
$route['tipo-atualizar'] = TipoController::TIPO_CONTROLLER . '/atualizar';


/**
 * @class
 */

$route['ug-novo'] = 'UgController/novo';
$route['ug-listar'] = 'UgController/listar';


/**
 * @class LoginController
 */

$route['sair'] = LoginController::LOGIN_CONTROLLER . '/sair';


/**
 * @class ModalidadeController
 */

$route['modalidade-listar'] = ModalidadeController::MODALIDADE_CONTROLLER . '/listar';
$route['modalidade-novo'] = ModalidadeController::MODALIDADE_CONTROLLER . '/novo';


/**
 * @class ProcessoController
 */

$route['processo-listar'] = ProcessoController::PROCESSO_CONTROLLER . '/listar';
$route['processo-listar-todos-completo'] = ProcessoController::PROCESSO_CONTROLLER . '/listarTodosProcessosCompleto';
$route['processo-listar-todos-incompleto'] = ProcessoController::PROCESSO_CONTROLLER . '/listarTodosProcessosIncompleto';
$route['processo-listar-excluidos'] = ProcessoController::PROCESSO_CONTROLLER . '/listarTodosExcluidos';
$route['processo-listar-por-sc'] = ProcessoController::PROCESSO_CONTROLLER . '/listarPorSetorDemandante';
$route['processo-novo'] = ProcessoController::PROCESSO_CONTROLLER . '/novo';
$route['processo-listar-almox'] = ProcessoController::PROCESSO_CONTROLLER . '/listarPorSetorDemandanteAlmox';
$route['processo-listar-aprov'] = ProcessoController::PROCESSO_CONTROLLER . '/listarPorSetorDemandanteAprov';
$route['processo-listar-saude'] = ProcessoController::PROCESSO_CONTROLLER . '/listarPorSetorDemandanteSaude';
$route['processo-listar-informatica'] = ProcessoController::PROCESSO_CONTROLLER . '/listarPorSetorDemandanteInformatica';
$route['processo-listar-transporte'] = ProcessoController::PROCESSO_CONTROLLER . '/listarPorSetorDemandanteMntTransp';
$route['processo-listar-salc'] = ProcessoController::PROCESSO_CONTROLLER . '/listarPorSetorDemandanteSalc';


/**
 * @class SugestaoController
 */

$route['sugestao-criar'] = SugestaoController::SUGESTAO_CONTROLLER . '/criar';


/**
 * @class UsuarioController
 */

$route['usuario-listar'] = UsuarioController::USUARIO_CONTROLLER . 'UsuarioController/listar';
$route['usuario-novo'] = UsuarioController::USUARIO_CONTROLLER . 'UsuarioController/novo';
$route['usuario-criar'] = UsuarioController::USUARIO_CONTROLLER . 'UsuarioController/criar';
$route['usuario-atualizar'] = UsuarioController::USUARIO_CONTROLLER . 'UsuarioController/atualizar';
$route['usuario-atualizar-usuario'] = UsuarioController::USUARIO_CONTROLLER . 'UsuarioController/atualizarUsuario';
$route['usuario-alterar-usuario'] = UsuarioController::USUARIO_CONTROLLER . 'UsuarioController/alterarUsuario';



