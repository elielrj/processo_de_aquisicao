<?php 

function td_excluir($link){
    
    $value = "<a href='" . base_url($link) . "'>" . 'Excluir' . "</a>";

    return "<td>{$value}</td>";
}

function td_alterar($link)
{

    $value = "<a href='" . base_url($link) . "'>Alterar</a>";

    return "<td>{$value}</td>";
}

function td_status($status)
{
    return "<td>" . ($status ? 'Ativo' : 'Inativo') . "</td>";
}

function td_value($value)
{
    return "<td>{$value}</td>";
}



?>