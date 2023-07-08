<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ProcessoImprimirLibrary
{

     private $ordem;

    public function imprimir($processo)
    {
        $this->ordem = 0;

        return $this->processoImprimirListaDeArtefatos($processo);
    }

    public function processoImprimirListaDeArtefatos($processo)
    {
       
        $listagemDeArtefatos = "";

        foreach ($processo->tipo->listaDeArtefatos as $artefato) {

            ++$this->ordem;

            if ($artefato->arquivo != null) {

                $listagemDeArtefatos .=
                    "</br>
                    <p>" . $this->ordem . " - " . $artefato->nome ."<p>
                    <div style='height: 1080px; width:100%;'>
                        <embed src='" . verificar_path($artefato->arquivo->path) . "' type='application/pdf' width='100%' height='100%'>
                    </div>
                ";
            }
        }

        $listagemDeArtefatos .= "";

        return $listagemDeArtefatos;
    }


}
