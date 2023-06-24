<?php

include_once('NivelDeAcesso.php');

class Leitor implements NivelDeAcesso
{
	const NOME = 'leitor';
	const NIVEL = 0;

	public function nome()
	{
        return Leitor::NOME;
    }
    

    public function nivel()
	{
        return Leitor::NIVEL;
    }

}

?>
