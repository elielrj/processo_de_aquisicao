<?php

    include('Usuario.php');
    include('Processo.php');

    class Arquivo
    {
        private $id;
        private $nome;
        private $path;
        private $nomeDoArquivo;
        private $dataDoUpload;
        private $processo;
        private $usuario;
        private $status;

        
        public function __construct(
            $id = null,
            $nome = null,
            $path = null,
            $nomeDoArquivo = null,
            $dataDoUpload = null,
            Processo $processo = null,
            Usuario $usuario = null,
            $status = null
        ){
            $this->id = $id;
            $this->nome = $nome;
            $this->path = $path;
            $this->nomeDoArquivo = $nomeDoArquivo;
            $this->dataDoUpload = $dataDoUpload;
            $this->processo = $processo;
            $this->usuario = $usuario;
            $this->status = $status;
        }

        function __get($key){
            return $this->$key;
        }
        
        function __set($key,$value){
            $this->$key = $value;
        }
    }