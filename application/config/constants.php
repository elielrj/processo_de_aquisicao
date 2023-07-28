<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') or define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE') or define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') or define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE') or define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE') or define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ') or define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE') or define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE') or define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE') or define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE') or define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE') or define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT') or define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT') or define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS') or define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR') or define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG') or define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE') or define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS') or define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') or define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT') or define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE') or define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN') or define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX') or define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


/**
 * CONSTANTE DA VERSÃO
 */
const VERSAO_PROCESSO_DE_AQUISICAO = 'Versão 3.0.1';

/**
 * CONSTATES DOS CONTROLLERS
 */


const LEI_TIPO_ARTEFATO_CONTROLLER = 'LeiTipoArtefatoController';
const LOGIN_CONTROLLER = 'LoginController';

/**
 * CONSTANTES O BANCO DE DADOS E VIEWS
 */


const DIRECTIONS_ASC = 'ASC';
const DIRECTIONS_DESC = 'DESC';
const ID = 'id';
const DATA_HORA = 'data_hora';
const PROCESSO_ID = 'processo_id';
const USUARIO_ID = 'usuario_id';
const STATUS = 'status';
const OBJETO = 'objeto';
const NUMERO = 'numero';
const DEPARTAMENTO_ID = 'departamento_id';
const LEI_ID = 'lei_id';
const TIPO_ID = 'tipo_id';
const COMPLETO = 'completo';
const CHAVE = 'chave';
const SENHA = 'senha';
const EMAIL = 'email';
/**
 * ERROS
 */
const ERRO_PATH = '#_ERRO_PATH';
const ERRO_ANDAMENTO = '#_ERRO_ANDAMENTO';


/**
 * Artefato DIEx no banco de datos deve estar igual ao número abaixo
 */
const ARTEFATO_DIEX_NO_BANCO_DE_DADOS = 53;

/**
 * Artefato Nota de Empenho no banco de datos deve estar igual ao número abaixo
 */
const ARTEFATO_NOTA_DE_EMPENHO_NO_BANCO_DE_DADOS = 63;

/**
 * Artefato Certidões no banco de datos deve estar igual ao número abaixo
 */
const ARTEFATO_CERTIDAO_TCU_NO_BANCO_DE_DADOS = 57;
const ARTEFATO_CERTIDAO_CADIN_NO_BANCO_DE_DADOS = 58;
const ARTEFATO_CERTIDAO_SICAF_NO_BANCO_DE_DADOS = 59;

/**
 * Id dos Departamentos dever ser os mesmo do banco de dados
 */
const ID_ALMOX_NO_BANCO_DE_DADOS = 1;
const ID_SALC_NO_BANCO_DE_DADOS = 2;
const ID_GARAGEM_NO_BANCO_DE_DADOS = 5;
const ID_APROV_NO_BANCO_DE_DADOS = 6;
const ID_SAUDE_NO_BANCO_DE_DADOS = 7;
const ID_INFOR_NO_BANCO_DE_DADOS = 8;


/**
 * SESSION
 */
const SESSION_ID = 'session_id';
const SESSION_NOME_DE_GUERRA = 'nome_de_guerra';
const SESSION_NOME_COMPLETO = 'nome_completo';
const SESSION_EMAIL = 'email';
const SESSION_CPF = 'CPF';
const SESSION_SENHA = 'senha';
const SESSION_DEPARTAMENTO_ID = 'departamento_id';
const SESSION_DEPARTAMENTO_NOME = 'departamento_nome';
const  SESSION_STATUS= 'status';
const SESSION_HIERARQUIA_ID = 'hierarquia_id';
const SESSION_HIERARQUIA_SIGLA = 'hierarquia_sigla';
const SESSION_FUNCAO_ID = 'funcao_id';
const SESSION_FUNCAO_NIVEL_DE_ACESSO = 'funcao_nivel_de_acesso';
