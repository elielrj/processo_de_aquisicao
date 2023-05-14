<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataLibrary{

     public static function  dataMySQL($data = 'now')
    {
        return (DataLibrary::agora(isset($data)))->format('Y-m-d');
    }

     public static function  dataBr($data = 'now')
    {
        return (DataLibrary::agora(isset($data)))->format('d-m-Y');
    }

     public static function  dataHoraMySQL($data = 'now')
    {
        return (DataLibrary::agora(isset($data)))->format('Y-m-d H:m:s');
    }

     public static function  dataHoraBr($data = 'now')
    {
        return (DataLibrary::agora(isset($data)))->format('d-m-Y H:m:s');
    }

     public static function  agora($data = 'now')
    {
        return new DateTime('now', DataLibrary::dateTimeZone());
    }

     public static function  dateTimeZone()
    {
        return new DateTimeZone('America/Sao_Paulo');
    }
}

?>