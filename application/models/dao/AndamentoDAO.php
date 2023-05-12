<?php

defined('BASEPATH') or exit('No direct script access allowed');

class AndamentoDAO extends CI_Model implements InterfaceCrudDAO
{

    public static function paraObjeto($arrayList)
    {
        return new Andamento(
            isset($arrayList->id) ? $arrayList->id : (isset($arrayList['id']) ? $arrayList['id'] : null),
            isset($arrayList->statusDoAndamento) ? (Andamento::selecionarStatus($arrayList->statusDoAndamento)) : (isset($arrayList['statusDoAndamento']) ? Andamento::selecionarStatus($arrayList['statusDoAndamento']) : null),
            isset($arrayList->dataHora) ? $arrayList->dataHora : (isset($arrayList['dataHora']) ? $arrayList['dataHora'] : null)
        );
    }
    
}