<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

	echo "<h1>{$titulo}</h1>";

    echo form_open('ProcessoController/criar', 
        array('class' => 'form-group')
    );

        echo form_label('Objeto do processo');
        echo form_input(
            array(
                'name' => 'objeto', 
                'class' => 'form-control', 
                'maxlength' => 150)
        );

            echo "</br>";

        echo form_label('Nup/Nud');
        echo form_input(
            array(
                'name' => 'nup_nud', 
                'class' => 'form-control', 
                'maxlength' => 20
            )
        );

            echo "</br>";
        
        echo form_submit(
            'enviar','Enviar', 
            array('class' => 'btn btn-primary btn-lg btn-block')
        );
        echo "<a href=" . base_url('index.php/processo') . 
                " class='btn btn-danger btn-lg btn-block' >Cancelar</a>";
    
    echo form_close();  
?>