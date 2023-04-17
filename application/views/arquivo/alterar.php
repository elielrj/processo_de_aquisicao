<?php defined('BASEPATH') OR exit('No direct script access allowed'); 


	echo "<h1>{$titulo}</h1>";

    echo form_open(
        'arquivo/atualizar', 
        array('class' => 'form-group')
    );

        echo form_input(
            array(
                'name' => 'id',
                'type' => 'hidden', 
                'value' => $tabela[0]['id']
            )
        );

        echo form_label('nome');
        echo form_input(
            array(
                'name' => 'objeto', 
                'class' => 'form-control', 
                'maxlength' => 150, 
                'value' => $tabela[0]['nome']
            )
        );

            echo "</br>";

        //echo form_label('CPF');

        echo form_input(
            array(
                'name' => 'cpf', 
                'class' => 'form-control', 
                'maxlength' => 20, 
                'value' => $tabela[0]['cpf'],
                'type' => 'hidden'
            )
        );

            echo "</br>";
        
        echo form_label('Nome do Arquivo');
        echo form_input(
            array(
                'name' => 'nomeDoArquivo', 
                'class' => 'form-control', 
                'maxlength' => 20, 
                'value' => $tabela[0]['nomeDoArquivo'],
                'type' => 'hidden'
            )
        );

            echo "</br>";

        echo form_dropdown(
            'processoId',
            $select,
            $selected,
            array(
                'class' => 'form-control', 
                'id' => 'processoId' 
            )
        );
            echo "</br>";
        
        echo form_submit(
            'enviar','Enviar', 
            array(
                'class' => 'btn btn-primary btn-lg btn-block'
            )
        );
        echo "<a href=" . base_url('index.php/arquivo') . 
                " class='btn btn-danger btn-lg btn-block' >Cancelar</a>";
    
    echo form_close();  
?>