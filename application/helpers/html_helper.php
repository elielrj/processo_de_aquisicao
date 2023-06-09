<?php

function td_excluir($controller, $id)
{
	$link = "index.php/{$controller}/deletar/{$id}";

	$value = "<a href='" . base_url($link) . "'>" . 'Excluir' . "</a>";

	return "<td>{$value}</td>";
}

function td_alterar($controller, $id, $name = 'Alterar')
{
	$link = "index.php/{$controller}/alterar/{$id}";

	$value = "<a href='" . base_url($link) . "'>$name</a>";

	return td_value($value);
}

function td_alterar_processo($numero, $processo_id, $departamento_id)
{
	$controller = 'ProcessoController';

	include_once('application/models/bo/nivel_de_acesso/Root.php');
	include_once('application/models/bo/nivel_de_acesso/Executor.php');

	if (
		$_SESSION['departamento_id'] == $departamento_id ||
		$_SESSION['funcao_nivel_de_acesso'] == Root::NOME ||
		$_SESSION['funcao_nivel_de_acesso'] == Executor::NOME
	) {
		return td_alterar($controller, $processo_id, $numero);
	} else {
		return td_value($numero);
	}
}

function td_status($status)
{
	return "<td>" . ($status ? 'Ativo' : 'Inativo') . "</td>";
}

function td_status_completo($status)
{
	return
		"<td><p style='color:" . ($status ? 'green' : 'red') . "'>" .
		($status
			? 'Finalizado'
			: 'Pendente') .
		"</p></td>";
}
function td_status_completo_com_href($status,$controller)
{
	return
		"<td><a href='".$controller."'><p style='color:" . ($status ? 'green' : 'red') . "'>" .
		($status
			? 'Finalizado'
			: 'Pendente') .
		"</p></a></td>";
}

function td_value($value)
{
	return "<td>{$value}</td>";
}

function td_ordem($value)
{
	return "<td>{$value}</td>";
}

function td_data_hora_br($value)
{

	return td_value(
		form_input(
			array(
				'type' => 'datetime',
				'value' => $value,
				'disabled' => 'disable',
				'class' => 'text-center'
			)
		)
	);
}

function td_data_br($value)
{
	return td_value(
		form_input(
			array(
				'type' => 'datetime',
				'value' => $value,
				'disabled' => 'disable',
				'class' => 'text-center'
			)
		)
	);
}

function from_array_to_table_row($arrayList)
{
	$line = "<tr class='text-center col-md-1'>";

	foreach ($arrayList as $value) {
		$line .= $value;
	}

	$line .= "</tr>";

	return $line;
}

function from_array_to_table_row_with_td($arrayList)
{
	$array = [];

	foreach ($arrayList as $value) {
		array_push($array, td_value($value));
	}
	return from_array_to_table_row($array);
}


function br_multiples($ate = 1)
{
	$count = 1;

	$value = '';

	do {

		$value .= '</br>';

		$count++;

	} while ($count <= $ate);

	return $value;
}

function view_titulo($titulo)
{
	echo "<h1>{$titulo}</h1>";
}

function view_tabela($tabela)
{
	echo
	"
            <table class='text-center fs-6'>
                <table class='table table-responsive-md table-hover'>
                    $tabela
                </table>
            </table>
        ";
}

function view_botao($botao)
{
	echo "<div class='row'>{$botao}</div>";
}

function view_form_open($controller)
{
	echo form_open($controller, array('class' => 'form-group'));
}

function view_form_open_multipart($controller)
{
	return form_open_multipart($controller, array('class' => 'form-control'));
}

function view_input($label, $name, $id, $type, $value = '', $maxlength = 250, $placeholder = '')
{
	echo
		(($type != 'hidden') ? form_label($label) : '') .

		form_input([
			'name' => $name,
			'id' => $id,
			'class' => 'form-control',
			'type' => $type,
			'value' => $value,
			'maxlength' => $maxlength,
			'placeholder' => $placeholder
		]);

	echo(($type != 'hidden') ? br_multiples() : '');
}

function view_input_com_required($label, $name, $id, $type, $value = '', $maxlength = 250, $placeholder = '')
{
	echo
		(($type != 'hidden') ? form_label($label) : '') .

		form_input([
			'name' => $name,
			'id' => $id,
			'class' => 'form-control',
			'type' => $type,
			'value' => $value,
			'maxlength' => $maxlength,
			'placeholder' => $placeholder,
			'required' => 'required'
		]);

	echo(($type != 'hidden') ? br_multiples() : '');
}

function view_input_name_value_type($name, $value = '', $type = 'hidden')
{
	return form_input([
		'name' => $name,
		'type' => $type,
		'value' => $value,
		'class' => 'form-control'
	]);
}

function view_text_area($label, $name, $id, $type, $value = '', $maxlength = 250)
{
	echo

		(($type != 'hidden') ? form_label($label) : '') .

		form_input([
			'name' => $name,
			'id' => $id,
			'class' => 'form-control',
			'type' => $type,
			'value' => $value,
			'maxlength' => $maxlength
		]) .

		(($type != 'hidden') ? br_multiples() : '');
}

function formulario_par_subir_arquivo($name = 'arquivo', $disabled = false)
{
	$array = [];

	if ($disabled) {

		$array = [
			'name' => $name,
			'type' => 'file',
			'accept' => '.pdf',
			'disabled' => 'disabled'
		];

	} else {
		$array = [
			'name' => $name,
			'type' => 'file',
			'accept' => '.pdf'
		];
	}

	return form_input($array);
}


function view_input_placeholder($name, $value = '', $placeholder = '', $disabled = false)
{
	$array = [];

	if ($disabled) {

		$array = [
			'name' => $name,
			'class' => 'form-control',
			'type' => 'text',
			'value' => $value,
			'maxlength' => 150,
			'placeholder' => $placeholder,
			'disabled' => 'disabled'
		];

	} else {
		$array = [
			'name' => $name,
			'class' => 'form-control',
			'type' => 'text',
			'value' => $value,
			'maxlength' => 150,
			'placeholder' => $placeholder
		];
	}
	return
		td_value(
			form_input($array)
		);

}

function view_form_submit_enviar()
{
	echo form_submit(
		'enviar',
		'Enviar',
		['class' => 'btn btn-primary btn-lg btn-block']
	);
}

function view_form_submit_cancelar($controller)
{
	echo
		"<a href=" .
		base_url('index.php/' . $controller) .
		" class='btn btn-danger btn-lg btn-block'>Cancelar</a>";
}

function view_form_submit_button($name, $value, $title, $disabled = false)
{
	$array = [];


	if ($disabled) {

		$array = [
			'class' => 'btn btn-primary',
			'title' => $title,
			'disabled' => 'disabled'
		];

	} else {
		$array = [
			'class' => 'btn btn-primary',
			'title' => $title,
		];
	}

	return form_submit(
		$name,
		$value,
		$array
	);
}

function tr_view($value, $class = 'text-left')
{
	return "<tr class={$class}>{$value}</tr>";
}

function view_dropdown_status($value = true, $label = 'Status')
{
	echo form_label($label) . form_dropdown(
			'status',
			[true => 'Ativo', false => 'Inativo'],
			$value,
			['class' => 'form-control']
		);
	echo br_multiples();
}

function view_dropdown($label, $name, $options, $value)
{
	echo form_label($label) . form_dropdown(
			$name,
			$options,
			$value,
			[
				'class' => 'form-control',
				'id' => $name
			]
		);
	echo br_multiples();
}

function estaSetado($value)
{
	return isset($value);
}

?>
