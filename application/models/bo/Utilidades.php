<?php

defined('BASEPATH') or exit('No direct script access allowed');

    interface Utilidades{

        public function transformarObjetoEmArray($objeto);

        public static function transformarArrayEmObjeto($arrayList);
    }

?>