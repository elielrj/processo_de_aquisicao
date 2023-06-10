<?php

include_once('NivelDeAcesso.php');

class Ler implements NivelDeAcesso
{
    const NIVEL = 4;
    const NOME = 'ler';

    public function nome(): string
	{
        return Ler::NOME;
    }
    

    public function nivel(): int
	{
        return Ler::NIVEL;
    }

}

?>
