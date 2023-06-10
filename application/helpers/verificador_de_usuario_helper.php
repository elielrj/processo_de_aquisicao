<?php

function usuarioPossuiSessaoAberta()
{
	return isset($_SESSION['email']);
}

function redirecionarParaPaginaInicial(): void
{
	header("Location:" . base_url());
}
