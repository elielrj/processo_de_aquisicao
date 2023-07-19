<table class='table table-responsive-md table-hover'>
	<tr class='text-left'>
		<td>Objeto:</td>
		<td><?php echo $processo->objeto ?></td>
	</tr>
	<tr class='text-left'>
		<td>Número do Processo (Nup/Nud):</td>
		<td><?php echo $processo->numero ?></td>
	</tr>
	<tr class='text-left'>
		<td>Data de abertura(Nup/Nud):</td>
		<td><?php echo data_hora($processo->dataHora) ?></td>
	</tr>
	<tr class='text-left'>
		<td>Chave para acompanhar:</td>
		<td><?php echo $processo->chave ?></td>
	</tr>
	<tr class='text-left'>
		<td>Modalidade:</td>
		<td><?php echo $processo->lei->modalidade->nome ?></td>
	</tr>
	<tr class='text-left'>
		<td>Amparo legal:</td>
		<td><?php echo $processo->lei->toString() ?></td>
	</tr>
	<tr class='text-left'>
		<td>Andamento:</td>
		<td><?php echo ucfirst(isset($processo->listaDeAndamento[0]) ? $processo->listaDeAndamento[0]->nome() : ERRO_ANDAMENTO) ?></td>
	</tr>
	<tr class='text-left'>
		<td>Histórico de movimento do Processo:</td>
		<td><?php echo processo_historico($processo) ?></td>
	</tr>
</table>
