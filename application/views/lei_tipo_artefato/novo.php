<?php

defined('BASEPATH') or exit('No direct script access allowed');

view_titulo($titulo);

view_form_open('lei-tipo-artefato-criar');

view_dropdown('Lei','lei_id',$options_lei);
view_dropdown('Tipo','tipo_id',$options_tipo);
view_dropdown('Artefato','artefato_id',$options_artefato);

view_dropdown_status();

view_form_submit_enviar();

view_form_submit_cancelar('lei-tipo-artefato-listar');

echo form_close();
