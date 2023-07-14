<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<h1><?php echo $titulo; ?></h1>

<table class='text-center fs-6'>
	<table class='table table-responsive-md table-hover'>
		<tr class='text-center col-md-1'>
			<td class='text-center col-md-1'>Id</td>
			<td class='text-center col-md-1'>Nome</td>
			<td class='text-center col-md-1'>Sigla</td>
			<td class='text-center col-md-1'>Status</td>
			<td class='text-center col-md-1'>Alterar</td>
			<td class='text-center col-md-1'>Excluir</td>
		</tr>
		<?php foreach ($tabela as $departamento) : ?>
			<tr class='text-center col-md-1'>
				<td class='text-center col-md-1'><?php echo $departamento->id ?></td>
				<td class='text-center col-md-3'><?php echo $departamento->nome ?></td>
				<td class='text-center col-md-3'><?php echo $departamento->sigla ?></td>
				<td class='text-center col-md-2'><?php echo status($departamento->status) ?></td>
				<td class='text-center col-md-1'><?php echo alterar(DEPARTAMENTO_CONTROLLER, $departamento->id) ?></td>
				<td class='text-center col-md-1'><?php echo excluir(DEPARTAMENTO_CONTROLLER, $departamento->id) ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
</table>

<?php echo $botoes ?>
