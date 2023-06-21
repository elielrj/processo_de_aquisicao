<?php
defined('BASEPATH') or exit('No direct script access allowed');

view_titulo($titulo);

echo 

    form_open('ProcessoController/criar', ['class' => 'form-group']) .

    form_input(['name' => 'id', 'type' => 'hidden']) .

    form_label('Objeto do processo') . form_input(['name' => 'objeto', 'class' => 'form-control', 'maxlength' => 250]) . "</br>" .

    form_label('Numero') . form_input(['name' => 'numero', 'class' => 'form-control', 'maxlength' => 20]) . "</br>" .

    //form_label('Data do Processo') . form_input(['name' => 'data', 'class' => 'form-control daterange', 'type' => 'date', 'value' => (new DateTime('now', new DateTimeZone('America/Sao_Paulo')))->format('d-m-Y')]) . "</br>" .

    //form_label('Seção') . form_dropdown('departamento_id', $departamentos, $departamento, ['class' => 'form-control']) . "</br>" .

    form_label('Tipo de Processo') . form_dropdown('tipo_id', $tipos, '', ['class' => 'form-control']) . "</br>" .

    form_label('Modalidade') . form_dropdown('modalidade_id', $modalidades, $lei_e_modalidade_pre_definido, ['class' => 'form-control', 'id' => 'modalidade_id']) . "</br>" .

    form_label('Lei') . form_dropdown('lei_id', $leis, $lei_e_modalidade_pre_definido, ['class' => 'form-control', 'id' => 'lei_id']) . "</br>" .

    form_input(['name' => 'completo', 'class' => 'form-control', 'type' => 'hidden', 'value' => false]);

view_form_submit_enviar();
view_form_submit_cancelar('processo-listar');

echo form_close();
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<script type="text/javascript">



    $(function () {
        $('#modalidade_id').change(function () {

            $('#lei_id').attr('disabled', 'disabled');
            $('#lei_id').html('<option>Carregando...</option>');

            var modalidade_id = $('#modalidade_id').val();

            $.post(
                "<?php echo base_url('index.php/LeiController/optionsPorModalidadeId') ?>",
                { modalidade_id: modalidade_id },
                function (data) {
                    $('#lei_id').html(data);
                    $('#lei_id').removeAttr('disabled');
                }
            );
        });


    });
</script>
