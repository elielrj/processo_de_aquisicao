<?php defined('BASEPATH') OR exit('No direct script access allowed'); 


	echo "<h1>{$titulo}</h1>";

    echo form_open(
        'processo/atualizar', 
        array('class' => 'form-group')
    );

        echo form_input(
            array(
                'name' => 'id',
                'type' => 'hidden', 
                'value' => $tabela[0]['id']
            )
        );

        echo form_label('Objeto do Processo');
        echo form_input(
            array(
                'name' => 'objeto', 
                'class' => 'form-control', 
                'maxlength' => 150, 
                'value' => $tabela[0]['objeto']
            )
        );

            echo "</br>";

        echo form_label('Nup/Nud');

        echo form_input(
            array(
                'name' => 'nupNud', 
                'class' => 'form-control', 
                'maxlength' => 20, 
                'value' => $tabela[0]['nupNud']
            )
        );

            echo "</br>";
        
        echo form_label('Data do Processo');
        echo form_input(
            array(
                'name' => 'dataDoProcesso', 
                'class' => 'form-control', 
                'value' => $tabela[0]['dataDoProcesso'],
                'disabled' => 'disabled'
            )
        );

            echo "</br>";

        echo form_label('Chave de Acesso');
        echo form_input(
            array(
                'name' => 'chaveDeAcesso', 
                'class' => 'form-control', 
                'value' => $tabela[0]['chaveDeAcesso'],
                'disabled' => 'disabled'
            )
        );

            echo "</br>";

        echo form_label('Usuário do Processo');
        echo form_input(
            array(
                'name' => 'usuarioId', 
                'class' => 'form-control', 
                'maxlength' => 100, 
                'value' => $tabela[0]['usuarioId'],
                'disabled' => 'disabled'
            )
        );

            echo "</br>";
        
        echo form_submit(
            'enviar','Enviar', 
            array(
                'class' => 'btn btn-primary btn-lg btn-block'
            )
        );
        echo "<a href=" . base_url('index.php/processo') . 
                " class='btn btn-danger btn-lg btn-block' >Cancelar</a>";
    
    echo form_close();  
?>