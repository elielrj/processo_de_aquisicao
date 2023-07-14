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
		<?php foreach ($tabela as $modalidade) : ?>
			<tr class='text-center col-md-1'>
				<td class='text-center col-md-1'><?php echo $modalidade->id ?></td>
				<td class='text-center col-md-1'><?php echo $modalidade->nome ?></td>
				<td class='text-center col-md-1'><?php echo status($modalidade->status) ?></td>
				<td class='text-center col-md-1'><?php echo alterar(MODALIDADE_CONTROLLER, $modalidade->id) ?></td>
				<td class='text-center col-md-1'><?php echo excluir(MODALIDADE_CONTROLLER, $modalidade->id) ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
</table>

<?php echo $botoes ?>
