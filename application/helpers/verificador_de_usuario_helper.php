<?php

function usuarioPossuiSessaoAberta()
{
    return isset($_SESSION['email'])
        ? true
        : false;
}
function redirecionarParaPaginaInicial()
{
    header("Location:" . base_url());
}

?>