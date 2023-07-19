<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<h1><?php echo $titulo; ?></h1>

<!-- cabeçalho -->
<div>

	<?php include_once 'exibir_cabecalho_processo.php'; ?>

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

	if ($ordem === 0) {
		?>
		<div>
			<p>Erro: Aquivo do processo não foi encontrato.</p>
		</div>
		<?php
	}
	?>
	</table>
</div>
