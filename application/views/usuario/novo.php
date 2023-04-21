<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

	echo "<h1>{$titulo}</h1>";

    echo form_open('UsuarioController/criar', 
        array('class' => 'form-group')
    );

        echo form_label('Email');
        echo form_input(
            array(
                'name' => 'email', 
                'class' => 'form-control', 
                'maxlength' => 150)
        );

            echo "</br>";

        echo form_label('CPF');
        echo form_input(
            array(
                'name' => 'cpf', 
                'class' => 'form-control', 
                'maxlength' => 20
            )
        );

            echo "</br>";

        echo form_label('Senha');
        echo form_input(
            array(
                'name' => 'senha', 
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