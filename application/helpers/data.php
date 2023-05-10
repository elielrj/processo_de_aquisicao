<?php
defined('BASEPATH') or exit('No direct script access allowed');




class Data{

    public function formatarData($data)
    {
        return form_input(
            array(
                'type' => 'datetime',
                'value' => (new DateTime($data))->format('d-m-Y'),
                'disabled' => 'disable',
                'class' => 'text-center'
            )
        );
    }

    

}

?>