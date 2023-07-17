<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<h1><?php echo $titulo; ?></h1>

<table class='text-center fs-6'>
	<table class='table table-responsive-md table-hover'>
		<tr class='text-center col-md-1'>
			<td class='text-center col-md-1'>DIEx</td>
			<td class='text-center col-md-1'>Tipo</td>
			<td class='text-center col-md-1'>Objeto</td>
			<td class='text-center col-md-1'>Número</td>
			<td class='text-center col-md-1'>Data</td>
			<td class='text-center col-md-1'>Seção</td>
			<td class='text-center col-md-1'>NE</td>
			<td class='text-center col-md-1'><img src='<?php echo base_url('img/icone-certificado.png'); ?>' width='16'
												  height='16'></td>
			<td class='text-center col-md-1'><i class="fa fa-history" aria-hidden="true"></i></td>
			<td class='text-center col-md-1'><i class='fa fa-eye' aria-hidden='true'></i></td>
			<td class='text-center col-md-1'><img src='<?php echo base_url('img/pencil-square.svg'); ?>' width='16'
												  height='16'></td>
			<td class='text-center col-md-1'><i class='fa fa-trash' aria-hidden='true'></i></td>
			<td class='text-center col-md-1'><i class="fa fa-file" aria-hidden="true"></i></td>
		</tr>
		<?php foreach ($tabela as $processo) : ?>
			<tr class='text-center col-md-1'>
				<td class='text-center col-md-1'><?php echo exibir_diex($processo) ?></td>
				<td class='text-center col-md-1'><?php echo $processo->tipo->nome ?></td>
				<td class='text-center col-md-3'><?php echo $processo->objeto ?></td>
				<td class='text-center col-md-1'><?php echo $processo->numero ?></td>
				<td class='text-center col-md-1'><?php echo data($processo->dataHora) ?></td>
				<td class='text-center col-md-1'><?php echo listar_processo_por_secao($processo->departamento) ?></td>
				<td class='text-center col-md-1'><?php echo exibir_ne($processo) ?></td>
				<td class='text-center col-md-1'><?php echo imprimir_certidoes($processo) ?></td>
				<td class='text-center col-md-1'><?php echo processo_historico($processo) ?></td>
				<td class='text-center col-md-1'><?php echo exibir_processo($processo->id) ?></td>
				<td class='text-center col-md-1'><?php echo alterar_processo($processo->id) ?></td>
				<td class='text-center col-md-1'><?php echo excluir_processo($processo) ?></td>
				<td class='text-center col-md-1'><i class="fa fa-print" aria-hidden="true"></i></td>
			</tr>
		<?php endforeach; ?>
	</table>
</table>

<?php echo $botoes ?>
