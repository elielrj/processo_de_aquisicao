<?php

function usuarioPossuiSessaoAberta()
{
	return isset($_SESSION['email']);
}

function redirecionarParaPaginaInicial()
{
	header("Location:" . base_url());
}
