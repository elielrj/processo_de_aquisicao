<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<h1><?php echo $titulo; ?></h1>

<table class='text-center fs-6'>
	<table class='table table-responsive-md table-hover'>
		<tr class='text-center col-md-1'>
			<td class='text-center col-md-1'>Id</td>
			<td class='text-center col-md-1'>Nome de Guerra</td>
			<td class='text-center col-md-1'>Nome Completo</td>
			<td class='text-center col-md-1'>Email</td>
			<td class='text-center col-md-1'>Cpf</td>
			<td class='text-center col-md-1'>Senha</td>
			<td class='text-center col-md-1'>Departamento</td>
			<td class='text-center col-md-1'>Status</td>
			<td class='text-center col-md-1'>Alterar</td>
			<td class='text-center col-md-1'>Excluir</td>
		</tr>
		<?php foreach ($tabela as $usuario) : ?>
			<tr class='text-center col-md-1'>
				<td class='text-center col-md-1'><?php echo $usuario->id ?></td>
				<td class='text-center col-md-3'><?php echo $usuario->nomeDeGuerra ?></td>
				<td class='text-center col-md-3'><?php echo $usuario->nomeCompleto ?></td>
				<td class='text-center col-md-3'><?php echo $usuario->email ?></td>
				<td class='text-center col-md-3'><?php echo $usuario->cpf ?></td>
				<td class='text-center col-md-3'><?php echo $usuario->senha ?></td>
				<td class='text-center col-md-3'><?php echo $usuario->departamento->sigla ?></td>
				<td class='text-center col-md-2'><?php echo status($usuario->status) ?></td>
				<td class='text-center col-md-1'><?php echo alterar(USUARIO_CONTROLLER, $usuario->id) ?></td>
				<td class='text-center col-md-1'><?php echo excluir(USUARIO_CONTROLLER, $usuario->id) ?></td>
			</tr>
		<?php endforeach; ?>
	</table>
</table>

<?php echo $botoes ?>
