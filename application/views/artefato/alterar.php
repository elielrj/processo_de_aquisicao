<?php

defined('BASEPATH') or exit('No direct script access allowed');

view_titulo($titulo);

view_form_open('ArtefatoController/atualizar');

view_input('Id','id', 'id', 'hidden', $artefato->id);

view_input('Ordem','ordem', 'ordem','text', $artefato->ordem);

view_input('Nome','nome', 'nome','text', $artefato->nome);

view_dropdown_status($artefato->status);

view_form_submit_enviar();

view_form_submit_cancelar('ArtefatoController');

form_close();