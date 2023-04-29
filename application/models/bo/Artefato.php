<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Artefato {

    private $id;
    private $nome;

    public function __construct(
            $id,
            $nome
    ) {
        $this->id = $id;
        $this->nome = $nome;
    }

    function __get($key) {
        return $this->$key;
    }

    function __set($key, $value) {
        $this->$key = $value;
    }

    public static function fromObjectToArray($object) {

        $id = isset($object->id) ? $object->id : null;

        $nome = isset($object->nome) ? $object->nome : null;

        return array(
            'id' => $id,
            'nome' => $nome);
    }

    public static function fromArrayToObject($array) {

        $id = isset($array->id) ? $array->id : null;

        $nome = isset($array->nome) ? $array->nome : null;

        return new Artefato($id, $nome);
    }

    public static function fromPostToObject($post) {

        $id = isset($post['id']) ? $post['id'] : null;

        $nome = isset($post['nome']) ? $post['nome'] : null;

        return new Artefato($id, $nome);
    }

}
