<?php

include_once('NivelDeAcesso.php');

class Administrador implements NivelDeAcesso
{
	const NOME = 'administrador';
	const NIVEL = 3;

	public function nome()
	{
        return Administrador::NOME;
    }
    

    public function nivel()
	{
        return Administrador::NIVEL;
    }

}

?>
