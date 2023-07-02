<?php

defined('BASEPATH') or exit('No direct script access allowed');

view_titulo($titulo);

view_form_open('UgController/criar');

view_input('Número','numero','numero','text','',6);
view_input('Nome da UG','nome','nome','text','',250);
view_input('Sigla','sigla','sigla','text','',150);

view_dropdown_status();

view_form_submit_enviar();

view_form_submit_cancelar('UgController');

echo form_close();
