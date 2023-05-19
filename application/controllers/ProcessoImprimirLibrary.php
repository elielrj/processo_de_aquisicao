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
                    "
                        <iframe  src='" . base_url($artefato->arquivo->path) . "' type='application/pdf'></iframe>
                   
                ";

                "https://stackoverflow.com/questions/69997184/merge-two-pdfs-with-ilovepdf-and-dompdf";
            }
        }

        $listagemDeArtefatos .= "";

        return $listagemDeArtefatos;
    }

//<embed src='" . base_url($artefato->arquivo->path) . "' type='application/pdf' width='100%' height='100%'>



}
