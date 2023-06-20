<?php

defined('BASEPATH') or exit('No direct script access allowed');

view_titulo($titulo);

view_form_open('LeiTipoArtefatoController/atualizar');

view_input('Id','id', 'id', 'hidden', $leiTipoArtefato->id);


view_dropdown('Lei','lei_id',$options_lei,$leiTipoArtefato->lei->id);
view_dropdown('Tipo','tipo_id',$options_tipo,$leiTipoArtefato->tipo->id);
view_dropdown('Artefato','artefato_id',$options_artefato,$leiTipoArtefato->artefato->id);

view_dropdown_status($leiTipoArtefato->status);

view_form_submit_enviar();

view_form_submit_cancelar('LeiTipoArtefatoController/listar');

form_close();
