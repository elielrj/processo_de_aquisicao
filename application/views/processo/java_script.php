
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

<script type="text/javascript">



	$(function () {
		$('#modalidade_id').change(function () {

			$('#lei_id').attr('disabled', 'disabled');
			$('#lei_id').html('<option>Carregando...</option>');

			var modalidade_id = $('#modalidade_id').val();

			$.post(
				"<?php echo base_url('index.php/LeiController/optionsPorModalidadeId') ?>",
				{ modalidade_id: modalidade_id },
				function (data) {
					$('#lei_id').html(data);
					$('#lei_id').removeAttr('disabled');
				}
			);
		});


	});
</script>
