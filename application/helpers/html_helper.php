<?php

function td_excluir($controller, $id)
{
    $link = "index.php/{$controller}/deletar/{$id}";

    $value = "<a href='" . base_url($link) . "'>" . 'Excluir' . "</a>";

    return "<td>{$value}</td>";
}

function td_alterar($controller, $id)
{
    $link = "index.php/{$controller}/alterar/{$id}";

    $value = "<a href='" . base_url($link) . "'>Alterar</a>";

    return "<td>{$value}</td>";
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
            : 'Pendente...') .
        "</p></td>";
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
                'value' => DataLibrary::dataHoraBr($value),
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
                'value' => DataLibrary::dataBr($value),
                'disabled' => 'disable',
                'class' => 'text-center'
            )
        )
    );
}

function from_array_to_table_row($arrayList)
{
    $line = "<tr class='text-center'>";

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


function br_multiples($value = 1)
{
    $count = 1;

    do{

        echo '</br>';

    }while($count <= $value);
}

function view_titulo($titulo)
{
    echo "<h1>{$titulo}</h1>";
}

function view_tabela($tabela)
{
    echo 
        "
            <table class=''>
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

?>