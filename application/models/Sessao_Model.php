<?php defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Sessao_Model extends CI_Model{       

        public function remover()
        {
            session_destroy();
        }

        public function criar($data)
        {
            $this->session->set_userdata($data);            
        }


    }