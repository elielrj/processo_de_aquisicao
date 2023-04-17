<?php

    class Upload extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                //$this->load->helper(array('form', 'url'));
        }

        public function index()
        {
                $this->load->view('upload/upload_form', array('error' => ' ' ));
        }

        public function do_upload()
        {
                var_dump($_FILES);

                $config['upload_path']          = './arquivos/';
                $config['allowed_types']        = 'pdf';
                $config['max_size']             = 10485760;
                $config['overwrite']             = uniqid();
                $config['file_ext_tolower'] = true;
                $config['max_filename'] = 250;

                $this->load->initialize($config);

                if ( ! $this->upload->do_upload('userfile'))
                {
                        $error = array('error' => $this->upload->display_errors());

                        $this->load->view('upload/upload_form', $error);
                }
                else
                {
                        $data = array('upload_data' => $this->upload->data());

                        $this->load->view('upload/upload_success', $data);
                }
        }
    }
?>