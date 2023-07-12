<?php
defined('BASEPATH') or exit('No direct script access allowed');

view_titulo($titulo);


view_tabela($tabela);

view_botao($botoes);

?>

	<tr class='text-center col-md-1'>
		<td class='text-center col-md-1'>Id</td>
		<td class='text-center col-md-1'>Status</td>
		<td class='text-center col-md-1'>Data/Hora</td>
		<td class='text-center col-md-1'>Processo</td>
		<td class='text-center col-md-1'>Usuário</td>
		<td class='text-center col-md-1'>Status</td>
	</tr>
<?php forech($andamentos as $andamento) : ?>
<tr class='text-center col-md-1'>
	<td class='text-center col-md-1'><?php $andamento->id ?></td>
	<td class='text-center col-md-1'><?php replace_od(replace_fisc_adm($andamento->statusDoAndamento->nome())) ?></td>
	<td class='text-center col-md-1'><?php $andamento->dataHora->dataHoraNoFormatoBrasileiro() ?></td>
	<td class='text-center col-md-1'><?php $andamento->processo->toString() ?></td>
	<td class='text-center col-md-1'><?php $andamento->usuario->toString() ?></td>
	<td class='text-center col-md-1'><?php $andamento->status ?></td>
</tr>
<?php endforech; ?>
