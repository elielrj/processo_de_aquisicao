<?php
defined('BASEPATH') or exit('No direct script access allowed');
$ordem = 0;
?>

<h1><?php echo $titulo; ?></h1>

<table class='text-center fs-6'>
	<table class='table table-responsive-md table-hover'>
		<tr class='text-center col-md-1'>
			<td class='text-center col-md-1'>Ordem</td>
			<td class='text-center col-md-1'>Status</td>
			<td class='text-center col-md-1'>Data/Hora</td>
			<td class='text-center col-md-1'>Usuário</td>
		</tr>
		<?php foreach ($tabela as $andamento) : ?>
			<tr class='text-center col-md-1'>
				<td class='text-center col-md-1'><?php echo ++$ordem; ?></td>
				<td class='text-center col-md-2'><?php echo replace_od(replace_fisc_adm($andamento->statusDoAndamento->nome())) ?></td>
				<td class='text-center col-md-2'><?php echo data_hora($andamento->dataHora) ?></td>
				<td class='text-center col-md-2'><?php echo $andamento->usuario->toString() ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
</table>
