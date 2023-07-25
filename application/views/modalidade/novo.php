<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>

<h1><?php echo $titulo; ?></h1>

<?php echo form_open(MODALIDADE_CONTROLLER.'/criar', ['class' => 'form-group']); ?>

</br>
<?php echo form_label('Nome'); ?>
<?php echo form_input(['name' => 'nome', 'class' => 'form-control', 'maxlength' => 250]); ?>

</br>
<?php echo form_label('Status'); ?>
<?php echo form_dropdown('status', [true => 'Ativo', false => 'Inativo'], true, ['class' => 'form-control']); ?>

</br>
<?php echo form_submit('enviar', 'Enviar', ['class' => 'btn btn-primary btn-lg btn-block']); ?>

<a href="<?php echo base_url('index.php/' . MODALIDADE_CONTROLLER); ?>" class='btn btn-danger btn-lg btn-block'>Cancelar</a>

<?php echo form_close(); ?>
