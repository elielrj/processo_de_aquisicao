<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<h1><?php echo $titulo; ?></h1>

<table class='text-center fs-6'>
	<table class='table table-responsive-md table-hover'>
		<tr class='text-center col-md-1'>
			<td class='text-center col-md-1'>Id</td>
			<td class='text-center col-md-1'>Nome</td>
			<td class='text-center col-md-1'>Status</td>
			<td class='text-center col-md-1'>Alterar</td>
			<td class='text-center col-md-1'>Excluir</td>
		</tr>
		<?php foreach ($tabela as $tipo) : ?>
			<tr class='text-center col-md-1'>
				<td class='text-center col-md-1'><?php echo $tipo->id ?></td>
				<td class='text-center col-md-3'><?php echo $tipo->nome ?></td>
				<td class='text-center col-md-2'><?php echo status($tipo->status) ?></td>
				<td class='text-center col-md-1'><?php echo alterar(TIPO_CONTROLLER, $tipo->id) ?></td>
				<td class='text-center col-md-1'><?php echo excluir(TIPO_CONTROLLER, $tipo->id) ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
</table>

<?php echo $botoes ?>
