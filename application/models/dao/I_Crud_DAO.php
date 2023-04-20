<?php

    interface I_Crud_DAO
    {
        public function create($object);
        public function retrive($index_initial,$show);
        public function retriveId($id);
        public function update($object);
        public function delete($id);
        public function count_rows();
        
    }
