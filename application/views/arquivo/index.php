<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<h1><?php echo $titulo; ?></h1>

<table class='text-center fs-6'>
	<table class='table table-responsive-md table-hover'>
		<tr class='text-center col-md-1'>
			<td class='text-center col-md-1'>Id</td>
			<td class='text-center col-md-1'>Path</td>
			<td class='text-center col-md-1'>Data/Hora do Upload</td>
			<td class='text-center col-md-1'>Nome</td>
			<td class='text-center col-md-1'>Processo</td>
			<td class='text-center col-md-1'>Usuário</td>
			<td class='text-center col-md-1'>Artefato</td>
			<td class='text-center col-md-1'>Status</td>
			<td class='text-center col-md-1'>Alterar</td>
			<td class='text-center col-md-1'>Excluir</td>
		</tr>
		<?php foreach ($tabela as $arquivo) :
			$path = file_exists($arquivo->path) ? $arquivo->path : ERRO_PATH;
			?>
			<tr class='text-center col-md-1'>
				<td class='text-center col-md-1'><?php echo $arquivo->id ?></td>
				<td class='text-center col-md-3'><?php echo($path === ERRO_PATH ? ERRO_PATH : path($path)) ?></td>
				<td class='text-center col-md-2'><?php echo $arquivo->dataHora ?></td>
				<td class='text-center col-md-3'><?php echo($arquivo->nome === '' ? '-' : $arquivo->nome) ?></td>
				<td class='text-center col-md-2'><?php echo $arquivo->processoId ?></td>
				<td class='text-center col-md-2'><?php echo $arquivo->usuarioId ?></td>
				<td class='text-center col-md-2'><?php echo $arquivo->artefatoId ?></td>
				<td class='text-center col-md-2'><?php echo status($arquivo->status) ?></td>
				<td class='text-center col-md-1'><?php echo alterar(ARQUIVO_CONTROLLER, $arquivo->id) ?></td>
				<td class='text-center col-md-1'><?php echo excluir(ARQUIVO_CONTROLLER, $arquivo->id) ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
</table>

<?php echo $botoes ?>
