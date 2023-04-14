<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Usuario_Model extends CI_Model {
        
        public static $TABELA_DB = 'usuario';
        
        public function __construct(){
            parent::__construct();
        }
        
        public function criar($usuario){
            $this->db->insert(
                self::$TABELA_DB, 
                $usuario);
        }

    }