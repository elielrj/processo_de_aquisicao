<?php


defined('BASEPATH') or exit('No direct script access allowed');

view_titulo($titulo);

view_form_open('ProcessoController/atualizar');

view_input('','id','id','hidden',$processo->id);

view_input('Objeto do Processo','objeto','objeto','text',$processo->objeto);
view_input('Número (Nup/Nud)','numero','numero','text',$processo->numero,20);
view_input('','data_hora','data_hora','hidden',DataLibrary::dataHoraMySQL());
view_input('','departamento_id','departamento_id','hidden',$processo->departamento->id);

view_dropdown('Tipo de Processo','tipo_id',$tipos_options,$processo->tipo->id);
view_dropdown('Modalidade','modalidade_id',$modalidades_options,$processo->lei->modalidade->id);
view_dropdown('Lei','lei_id',$leis_options,$processo->lei->id);


view_input('','completo','completo','hidden',$processo->completo);

view_input('','chave','chave','hidden',$processo->chave);

view_input('','status','status','hidden',$processo->status);

view_form_submit_enviar();
view_form_submit_cancelar('processo-listar');

form_close();

require_once 'java_script.php';

?>
