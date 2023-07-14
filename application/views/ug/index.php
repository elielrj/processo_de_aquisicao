<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<h1><?php echo $titulo; ?></h1>

<table class='text-center fs-6'>
	<table class='table table-responsive-md table-hover'>
		<tr class='text-center col-md-1'>
			<td class='text-center col-md-1'>Id</td>
			<td class='text-center col-md-1'>UASG</td>
			<td class='text-center col-md-1'>OM</td>
			<td class='text-center col-md-1'>Sigla</td>
			<td class='text-center col-md-1'>Status</td>
			<td class='text-center col-md-1'>Alterar</td>
			<td class='text-center col-md-1'>Excluir</td>
		</tr>
		<?php foreach ($tabela as $ug) : ?>
			<tr class='text-center col-md-1'>
				<td class='text-center col-md-1'><?php echo $ug->id ?></td>
				<td class='text-center col-md-3'><?php echo $ug->numero ?></td>
				<td class='text-center col-md-3'><?php echo $ug->nome ?></td>
				<td class='text-center col-md-3'><?php echo $ug->sigla ?></td>
				<td class='text-center col-md-2'><?php echo status($ug->status) ?></td>
				<td class='text-center col-md-1'><?php echo alterar(UG_CONTROLLER, $ug->id) ?></td>
				<td class='text-center col-md-1'><?php echo excluir(UG_CONTROLLER, $ug->id) ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
</table>

<?php echo $botoes ?>
