<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<h1><?php echo $titulo; ?></h1>

<table class='text-center fs-6'>
	<table class='table table-responsive-md table-hover'>
		<tr class='text-center col-md-1'>
			<td class='text-center col-md-1'>Id</td>
			<td class='text-center col-md-1'>Status</td>
			<td class='text-center col-md-1'>Data/Hora</td>
			<td class='text-center col-md-1'>Usuário</td>
			<td class='text-center col-md-1'>Status</td>
			<td class='text-center col-md-1'>Alterar</td>
			<td class='text-center col-md-1'>Excluir</td>
		</tr>
		<?php foreach ($tabela as $andamento) : ?>
			<tr class='text-center col-md-1'>
				<td class='text-center col-md-1'><?php echo $andamento->id ?></td>
				<td class='text-center col-md-1'><?php echo replace_od(replace_fisc_adm($andamento->statusDoAndamento->nome())) ?></td>
				<td class='text-center col-md-1'><?php echo data_hora($andamento->dataHora) ?></td>
				<td class='text-center col-md-1'><?php echo $andamento->usuario->toString() ?></td>
				<td class='text-center col-md-1'><?php echo status($andamento->status) ?></td>
				<td class='text-center col-md-1'><?php echo alterar(ANDAMENTO_CONTROLLER, $andamento->id) ?></td>
				<td class='text-center col-md-1'><?php echo excluir(ANDAMENTO_CONTROLLER, $andamento->id) ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
</table>

<?php echo $botoes ?>
