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
		<a href=" <?php echo base_url('index.php/' . PROCESSO_CONTROLLER . '/exibir/' . $processo->id) ?>"
		   class='btn btn-primary btn-lg btn-block'>Visualização completa</a>
		</br>
	</div>
	<div>
		<a href=" <?php echo base_url('index.php/' . PROCESSO_CONTROLLER . '/imprimir/' .
			$processo->id) ?>" class='btn btn-primary btn-lg btn-block'> Imprimir todo processo</a>
		</br>
	</div>
</div>


<!-- Artefatos -->

<div>
	<table class="table table-responsive-md table-hover">
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

					<tr>
						<td><?php echo $ordem . ($subindice > 0 ? ('.' . $subindice) : ''); ?></td>
						<td>
							<a href='<?php echo(file_exists($arquivo->path) ? base_url($arquivo->path) : '') ?>'>
								<?php echo $artefato->nome . ($arquivo->nome != '' ? ' - Descrição do anexo: ' . $arquivo->nome : ''); ?>
							</a>
						</td>
						<?php form_open_multipart(ARQUIVO_CONTROLLER . '/alterarArquivoDeUmProcesso', ['class' => 'form-control']) ?>
						<td><?php echo form_input([
								'name' => 'arquivo_nome',
								'class' => 'form-control',
								'type' => 'text',
								'value' => $arquivo->nome ?? '',
								'maxlength' => 150,
								'placeholder' => 'Descrição'
							]) ?>
						</td>
						<?php
						form_input([
							'name' => 'arquivo_id',
							'type' => 'hidden',
							'value' => $arquivo->id,
							'class' => 'form-control']);
						form_input([
							'name' => 'processo_id',
							'type' => 'hidden',
							'value' => $processo->id,
							'class' => 'form-control']);
						form_input([
							'name' => 'artefato_id',
							'type' => 'hidden',
							'value' => $artefato->id,
							'class' => 'form-control']);
						form_input([
							'name' => 'arquivo_status',
							'type' => 'hidden',
							'value' => ($arquivo->status ?? true),
							'class' => 'form-control']);
						form_input([
							'name' => 'arquivo_path',
							'type' => 'hidden',
							'value' => (file_exists($arquivo->path) ? $arquivo->path : ''),
							'class' => 'form-control']);
						?>
						<td><?php echo form_input([
								'name' => 'arquivo',
								'type' => 'file',
								'accept' => '.pdf'
							]) ?>
						</td>
						<td>
							<?php echo form_submit(
								'enviar',
								'Upload/Atualizar',
								[
									'class' => 'btn btn-primary',
									'title' => 'Sobe um novo ou atualiza o arquivo para este artefato do processo'
								]) ?>
						</td>
						<td>
							<?php echo form_submit(
								'mais_um',
								'+',
								[
									'class' => 'btn btn-primary',
									'title' => 'Incluir mais arquivo para este artefato'
								]) ?>
						</td>
						<td>
							<?php echo form_submit(
								'menos_um',
								'-',
								[
									'class' => 'btn btn-primary',
									'title' => 'Excluir artefato'
								]) ?>
						</td>
						<?php form_close(); ?>
					</tr>

					<?php

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
