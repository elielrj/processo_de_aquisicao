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
                'name' => 'nup_nud', 
                'class' => 'form-control', 
                'maxlength' => 20, 
                'value' => $tabela[0]['nup_nud']
            )
        );

            echo "</br>";
        
        echo form_label('Data do Processo');

        $timezone = new DateTimeZone('America/Sao_Paulo');
        $data_hora = new DateTime($tabela[0]['data_do_processo'], $timezone);

        echo form_input(
            array(
                'name' => 'data_do_processo', 
                'class' => 'form-control', 
                'value' => $data_hora->format('d-m-Y H:m:s'),
                'disabled' => 'disabled'
            )
        );

            echo "</br>";

        echo form_label('Chave de Acesso');
        echo form_input(
            array(
                'name' => 'chave_de_acesso', 
                'class' => 'form-control', 
                'value' => $tabela[0]['chave_de_acesso'],
                'disabled' => 'disabled'
            )
        );

            echo "</br>";

        echo form_label('Usuário do Processo');
        echo form_input(
            array(
                'name' => 'usuario_id', 
                'class' => 'form-control', 
                'maxlength' => 100, 
                'value' => $tabela[0]['usuario_id']['email'],
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