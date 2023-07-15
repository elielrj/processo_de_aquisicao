<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>


<h1><?php echo $titulo; ?></h1>

<!-- cabeçalho -->
<div>
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
			<td><?php echo $processo->lei->modalidade->nome ?>></td>
		</tr>
		<tr class='text-left'>
			<td>Amparo legal:</td>
			<td><?php echo $processo->lei->toString() ?>></td>
		</tr>
		<tr class='text-left'>
			<td>Andamento:</td>
			<td><?php echo ucfirst($processo->listaDeAndamento[0]->nome()) ?></td>
		</tr>
		<tr class='text-left'>
			<td>Status do Processo:</td>
			<td><?php echo processo_completo($processo->completo) ?></td>
		</tr>
	</table>

</div>

<!-- Artefatos -->

<div>
	<br class="table table-responsive-md table-hover">
	<?php

	$ordem = 0;

	foreach ($processo->tipo->listaDeArtefatos as $artefato) {



		if ($artefato->arquivos != array()) {

			$subindice = 0; //Sub-índice para Cada Artefato repetido
			foreach ($artefato->arquivos as $arquivo) {

				++$ordem; //Ordem de cada Artefato, somente se exirtir algum arquivo nos artefatos

				if (count($artefato->arquivos) > 1) {
					$subindice++;
				}

				if (file_exists($arquivo->path)) { ?>

					<p>
						<?php
						echo
							$ordem . ($subindice > 0 ? ('.' . $subindice) : '') . //Título do Artefato: "1. Artefato A"
							'. ' .
							$artefato->nome . ($arquivo->nome != '' ? ' - Descrição do anexo: ' . $arquivo->nome : ''); //Título do Artefato: "1.2 Artefato A-2"
						?>
					</p>
					<div style='height: 1080px; width: 100%;'>
						<embed src='<?php echo base_url($arquivo->path) ?>' type='application/pdf' width='100%'
							   height='100%'>
					</div>
					</br>
					<?php
				} else {
					?>
					<p>
						<?php
						echo
							$ordem . ($subindice > 0 ? ('.' . $subindice) : '') . //Título do Artefato: "1. Artefato A"
							$artefato->nome . ($arquivo->nome != '' ? ' - Descrição do anexo: ' . $arquivo->nome : ''); //Título do Artefato: "1.2 Artefato A-2"
						?>
					<p>
					<div>
						<p>Erro: Aquivo do processo não foi encontrato.</p>
					</div>
					<?php
				}
			}
		}
	}
	?>
	</table>
</div>
