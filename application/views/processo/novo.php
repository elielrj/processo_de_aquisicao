<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

    $form_open = array('class' => 'form-group');
    $input_objeto = array('name' => 'objeto', 'class' => 'form-control', 'maxlength' => 150);
    $input_nup = array('name' => 'nupNud', 'class' => 'form-control', 'maxlength' => 20);
    $form_submit_btn = array('class' => 'btn btn-primary btn-lg btn-block');


	echo "<h1>{$titulo}</h1>";

    echo form_open('processo/criar', $form_open);

        echo form_label('Objeto do processo');
        echo form_input($input_objeto);

            echo "</br>";

        echo form_label('Nup/Nud');
        echo form_input($input_nup);

            echo "</br>";
        
        echo form_submit('enviar','Enviar', $form_submit_btn);
        echo "<a href=" . base_url('index.php/processo') . 
                " class='btn btn-danger btn-lg btn-block' >Cancelar</a>";
    
    echo form_close();  
?>