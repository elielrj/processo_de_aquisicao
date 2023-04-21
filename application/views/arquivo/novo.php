<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

	echo "<h1>{$titulo}</h1>";

    echo form_open_multipart('ArquivoController/criar', 
        array('class' => 'form-group')
    );

        echo form_label('Nome');
        echo form_input(
            array(
                'name' => 'nome', 
                'class' => 'form-control', 
                'maxlength' => 150)
        );

            echo "</br>";

        echo form_dropdown(
            'processo_id',
            $processos,
            '',
            array(
                'class' => 'form-control', 
                'id' => 'processo_id' 
            )
        );

            echo "</br>";

        echo form_input(
        array(
            'name' => 'arquivo', 
            'class' => '', 
            'type' => 'file')
        );

        echo "</br>";
        
        echo form_submit(
            'enviar','Enviar', 
            array('class' => 'btn btn-primary btn-lg btn-block')
        );
        echo "<a href=" . base_url('index.php/arquivo') . 
                " class='btn btn-danger btn-lg btn-block' >Cancelar</a>";
    
    echo form_close();  
    
?>