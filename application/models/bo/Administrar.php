<?php

include_once('NivelDeAcesso.php');

class Administrar implements NivelDeAcesso
{
    const NIVEL = 4;
    const NOME = 'administrador';

    public function nome(): string
	{
        return Administrar::NOME;
    }
    

    public function nivel(): int
	{
        return Administrar::NIVEL;
    }

}

?>
