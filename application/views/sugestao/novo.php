<?php

defined('BASEPATH') or exit('No direct script access allowed');


view_titulo($titulo);

view_form_open(SugestaoController::$controller . '/criar');

view_text_area('Sugestão', 'mensagem', 'mensagem', 'textarea');

view_form_submit_enviar();

view_form_submit_cancelar('processos');

echo form_close();