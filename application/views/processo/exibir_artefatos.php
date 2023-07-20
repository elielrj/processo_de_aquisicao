<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<h1><?php echo $titulo; ?></h1>

<!-- cabeçalho -->
<div>

	<?php include_once 'exibir_cabecalho_processo.php'; ?>

</div>

<!-- Botões de VISUALIZAÇÃO e IMPRIMIR -->
<div>
	<div>
		<a href=" <?php base_url('index.php/ProcessoController/visualizarProcesso/' . $processo->id) ?>"
		   class='btn btn-primary btn-lg btn-block'>Visualização completa</a>
	</div>
	<div>
		<a href=" <?php base_url('index.php/ProcessoController/imprimirProcesso/' .
			$processo->id) ?>" class='btn btn-primary btn-lg btn-block'> Imprimir todo processo</a>
	</div>
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
				?>
				<div>
					<p>
						<?php
						echo
							$ordem . ($subindice > 0 ? ('.' . $subindice) : '') . //Título do Artefato: "1. Artefato A"
							'. ' .
							$artefato->nome . ($arquivo->nome != '' ? ' - Descrição do anexo: ' . $arquivo->nome : ''); //Título do Artefato: "1.2 Artefato A-2"
						?>
					</p>
				</div>

				<?php $path = '';

				if (file_exists($arquivo->path)) {
					$path = $arquivo->path;
				}
				?>

				<div>
					<td><?php echo $ordem . ($subindice > 0 ? ('.' . $subindice) : ''); ?></td>
					<td><?php echo $path; ?></td>
					<?php form_open_multipart(ARQUIVO_CONTROLLER . '/alterarArquivoDeUmProcesso', ['class' => 'form-control']) ?>
					<td><?php form_input([
							'name' => 'arquivo_nome',
							'class' => 'form-control',
							'type' => 'text',
							'value' => $arquivo->nome ?? '',
							'maxlength' => 150,
							'placeholder' => 'Descrição',
							'disabled' => $processo->demandante->id === $_SESSION[SESSION_DEPARTAMENTO_ID]
						]) ?></td>
				</div>

				<?php

			}
		} else {
			//exibir artefato sem hiperlink para arquivo

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
