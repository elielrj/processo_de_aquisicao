<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<h1><?php echo $titulo; ?></h1>

<table class='text-center fs-6'>
	<table class='table table-responsive-md table-hover'>
		<tr class='text-center col-md-1'>
			<td class='text-center col-md-1'>Id</td>
			<td class='text-center col-md-1'>Número</td>
			<td class='text-center col-md-1'>Artigo</td>
			<td class='text-center col-md-1'>Inciso</td>
			<td class='text-center col-md-1'>Data</td>
			<td class='text-center col-md-1'>Nome</td>
			<td class='text-center col-md-1'>Status</td>
			<td class='text-center col-md-1'>Alterar</td>
			<td class='text-center col-md-1'>Excluir</td>
		</tr>
		<?php foreach ($tabela as $lei) : ?>
			<tr class='text-center col-md-1'>
				<td class='text-center col-md-1'><?php echo $lei->id ?></td>
				<td class='text-center col-md-1'><?php echo $lei->numero ?></td>
				<td class='text-center col-md-1'><?php echo $lei->artigo ?></td>
				<td class='text-center col-md-1'><?php echo $lei->inciso ?></td>
				<td class='text-center col-md-1'><?php echo $lei->data ?></td>
				<td class='text-center col-md-1'><?php echo $lei->modalidade->nome ?></td>
				<td class='text-center col-md-1'><?php echo status($lei->status) ?></td>
				<td class='text-center col-md-1'><?php echo alterar(LEI_CONTROLLER, $lei->id) ?></td>
				<td class='text-center col-md-1'><?php echo excluir(LEI_CONTROLLER, $lei->id) ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
</table>

<?php echo $botoes ?>
