<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>

<h1><?php echo $titulo; ?></h1>

<?php echo form_open(LEI_TIPO_ARTEFATO_CONTROLLER.'/criar', ['class' => 'form-group']); ?>

<?php echo form_label('Lei'); ?>
<?php echo form_dropdown('lei_id', $options_lei, '',['class' => 'form-control']); ?>

</br>
<?php echo form_label('Tipo'); ?>
<?php echo form_dropdown('tipo_id', $options_tipo, '',['class' => 'form-control']); ?>

</br>
<?php echo form_label('Artefato'); ?>
<?php echo form_dropdown('artefato_id', $options_artefato, '',['class' => 'form-control']); ?>

</br>
<?php echo form_label('Status'); ?>
<?php echo form_dropdown('status', [true => 'Ativo', false => 'Inativo'], true, ['class' => 'form-control']); ?>

</br>
<?php echo form_submit('enviar', 'Enviar', ['class' => 'btn btn-primary btn-lg btn-block']); ?>

<a href="<?php echo base_url('index.php/' . LEI_TIPO_ARTEFATO_CONTROLLER); ?>" class='btn btn-danger btn-lg btn-block'>Cancelar</a>

<?php echo form_close(); ?>
