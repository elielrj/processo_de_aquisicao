<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<h1><?php echo $titulo; ?></h1>

<table class='text-center fs-6'>
	<table class='table table-responsive-md table-hover'>
		<tr class='text-center col-md-1'>
			<td class='text-center col-md-1'>Id</td>
			<td class='text-center col-md-1'>Lei</td>
			<td class='text-center col-md-1'>Tipo</td>
			<td class='text-center col-md-1'>Artefato</td>
			<td class='text-center col-md-1'>Status</td>
			<td class='text-center col-md-1'>Alterar</td>
			<td class='text-center col-md-1'>Excluir</td>
		</tr>
		<?php foreach ($tabela as $leiTipoArtefato) : ?>
			<tr class='text-center col-md-1'>
				<td class='text-center col-md-1'><?php echo $leiTipoArtefato->id ?></td>
				<td class='text-center col-md-3'><?php echo $leiTipoArtefato->lei->toString() ?></td>
				<td class='text-center col-md-2'><?php echo $leiTipoArtefato->tipo->nome ?></td>
				<td class='text-center col-md-3'><?php echo $leiTipoArtefato->artefato->nome ?></td>
				<td class='text-center col-md-1'><?php echo status($leiTipoArtefato->status) ?></td>
				<td class='text-center col-md-1'><?php echo alterar(LEI_TIPO_ARTEFATO_CONTROLLER, $leiTipoArtefato->id) ?></td>
				<td class='text-center col-md-1'><?php echo excluir(LEI_TIPO_ARTEFATO_CONTROLLER, $leiTipoArtefato->id) ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
</table>

<?php echo $botoes ?>
