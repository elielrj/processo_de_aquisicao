<?php
defined('BASEPATH') or exit('No direct script access allowed');

view_titulo($titulo);

view_form_open('ProcessoController/criar');

view_input_com_required('Objeto do Processo','objeto','objeto','text');
view_input_com_required('Número (Nup/Nud)','numero','numero','text','',20);
view_input('','data_hora','data_hora','hidden',DataLibrary::dataHoraMySQL());
view_input('','departamento_id','departamento_id','hidden',$_SESSION['departamento_id']);

view_dropdown('Tipo de Processo','tipo_id',$tipos_options,'');

view_dropdown('Modalidade','modalidade_id',$modalidades_options,$lei_e_modalidade_pre_definido);

view_dropdown('Lei','lei_id',$leis_options,$lei_e_modalidade_pre_definido);

view_input('','completo','completo','hidden',false);

view_input('','chave','chave','hidden',uniqid());

view_form_submit_enviar();

view_form_submit_cancelar('processo-listar');

form_close();

require_once 'java_script.php';


?>

