<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>

	<h1><?php echo $titulo; ?></h1>

<?php echo form_open(LEI_CONTROLLER . '/atualizar', ['class' => 'form-group']); ?>

<?php echo form_input(['name' => 'id', 'class' => 'form-control', 'type' => 'hidden', 'value' => $lei->id]); ?>

	</br>
<?php echo form_label('Número') ?>
<?php echo form_input(['name' => 'numero', 'class' => 'form-control', 'maxlength' => 250, 'value' => $lei->numero]) ?>

	</br>
<?php echo form_label('Artigo') ?>
<?php echo form_input(['name' => 'artigo', 'class' => 'form-control', 'maxlength' => 250, 'value' => $lei->artigo]) ?>

	</br>
<?php echo form_label('Inciso') ?>
<?php echo form_input(['name' => 'inciso', 'class' => 'form-control', 'maxlength' => 250, 'value' => $lei->inciso]) ?>

	</br>
<?php echo form_label('Data') ?>
<?php echo form_input(['name' => 'data', 'type' => 'date', 'class' => 'form-control', 'maxlength' => 250, 'value' => $lei->data]) ?>

	</br>
<?php echo form_label('Modalidade'); ?>
<?php echo form_dropdown('modalidade_id', $options_modalidades, $lei->modalidade->id, ['class' => 'form-control']); ?>

	</br>
<?php echo form_label('Status'); ?>
<?php echo form_dropdown('status', [true => 'Ativo', false => 'Inativo'], $lei->status, ['class' => 'form-control']) ?>

	</br>
<?php echo form_submit('enviar', 'Enviar', ['class' => 'btn btn-primary btn-lg btn-block']); ?>

	<a href="<?php echo base_url('index.php/' . LEI_CONTROLLER); ?>"
	   class='btn btn-danger btn-lg btn-block'>Cancelar</a>

<?php echo form_close(); ?>
