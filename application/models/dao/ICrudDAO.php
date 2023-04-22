<?php
defined('BASEPATH') or exit('No direct script access allowed');

    interface ICrudDAO
    {
        public function create($object);
        public function retrive($index_initial,$show);
        public function retriveId($id);
        public function update($object);
        public function delete($id);
        public function count_rows();
        
    }
