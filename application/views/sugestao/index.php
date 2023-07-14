<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<h1><?php echo $titulo; ?></h1>

<table class='text-center fs-6'>
	<table class='table table-responsive-md table-hover'>
		<tr class='text-center col-md-1'>
			<td class='text-center col-md-1'>Id</td>
			<td class='text-center col-md-1'>Mensagem</td>
			<td class='text-center col-md-1'>Usuário</td>
			<td class='text-center col-md-1'>Status</td>
			<td class='text-center col-md-1'>Alterar</td>
			<td class='text-center col-md-1'>Excluir</td>
		</tr>
		<?php foreach ($tabela as $sugestoes) : ?>
			<tr class='text-center col-md-1'>
				<td class='text-center col-md-1'><?php echo $sugestoes->id ?></td>
				<td class='text-center col-md-3'><?php echo $sugestoes->mensagem ?></td>
				<td class='text-center col-md-3'><?php echo $sugestoes->usuario_id ?></td>
				<td class='text-center col-md-2'><?php echo status($sugestoes->status) ?></td>
				<td class='text-center col-md-1'><?php echo alterar(SUGESTAO_CONTROLLER, $sugestoes->id) ?></td>
				<td class='text-center col-md-1'><?php echo excluir(SUGESTAO_CONTROLLER, $sugestoes->id) ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
</table>

<?php echo $botoes ?>
