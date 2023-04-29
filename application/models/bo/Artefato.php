<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Artefato
{
    private $id;
    private $nome;


    public function __construct(
        $id,
        $nome
    ) {
        $this->id = $id;
        $this->nome = $nome;
    }

    function __get($key)
    {
        return $this->$key;
    }

    function __set($key, $value)
    {
        $this->$key = $value;
    }

    public static function toArray($object)
    {

    }

    public static function fromArray($array)
    {
        return new Artefato(
            isset($array['id']) ? $array['id'] : null,
            isset($array['nome']) ? $array['nome'] : null
        );
    }
}