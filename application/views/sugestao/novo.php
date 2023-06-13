<?php

defined('BASEPATH') or exit('No direct script access allowed');


view_titulo($titulo);

view_form_open('sugestao-criar');

view_text_area('Sugestão', 'mensagem', 'mensagem', 'text');

view_form_submit_enviar();

view_form_submit_cancelar('processo-listar');

echo form_close();
