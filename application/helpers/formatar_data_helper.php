<?php
defined('BASEPATH') or exit('No direct script access allowed');

class formatar_data_helper
{
    public function dataMySQL($data = null)
    {
        return ($this->agora(isset($data)))->format('Y-m-d');
    }

    public function dataBr($data = null)
    {
        return ($this->agora(isset($data)))->format('d-m-Y');
    }

    public function dataHoraMySQL($data = null)
    {
        return ($this->agora(isset($data)))->format('Y-m-d H:m:s');
    }

    public function dataHoraBr($data = null)
    {
        return ($this->agora(isset($data)))->format('d-m-Y H:m:s');
    }

    private function agora($data = 'now')
    {
        return new DateTime($data, $this->dateTimeZone());
    }

    private function dateTimeZone()
    {
        return new DateTimeZone('America/Sao_Paulo');
    }
}

?>