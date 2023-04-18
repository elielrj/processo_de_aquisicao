<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Arquivo_Model extends CI_Model {
        
        public static $TABELA_DB = 'arquivo';
        
        public function __construct(){
            parent::__construct();
        }
        
        public function criar($arquivo){
            $this->db->insert(
                self::$TABELA_DB, 
                $arquivo);
        }

        public function retrive($indiceInicial,$mostrar){
           
            $resultado = $this->db->get(
                self::$TABELA_DB,
                $mostrar,
                $indiceInicial                
            ); 
 
            return $this->montarObjetoArquivo($resultado->result());
        }

        public function retriveId($id){
            
            $resultado = 
            $this->db->get_where(
                self::$TABELA_DB,
                array('id'=> $id)
            );   
            
            return $this->montarObjetoArquivo($resultado->result());
        }

        public function update($arquivo){

            $this->db->update(
                self::$TABELA_DB,
                $arquivo, 
                array('id'=> $arquivo['id'])
            );
        }

        public function delete($id){
            return $this->db->delete(
                self::$TABELA_DB,
                array('id'=> $id));
        }

        public function montarObjetoArquivo($result){

            $listaDeArquivos = array();

            foreach($result as $linha){
                $arquivo = $this->arquivo(
                    $linha->id,
                    $linha->nome,
                    $linha->path,
                    $linha->nome_do_arquivo,
                    $linha->data_do_upload,
                    $linha->processo_id,
                    $linha->usuario_id,                    
                    $linha->status                    
                );

                array_push($listaDeArquivos, $arquivo);
           }
            return $listaDeArquivos;
        }

        public function arquivo(
            $id,
            $nome,
            $path,
            $nome_do_arquivo,
            $data_do_upload,
            $processo_id,
            $usuario_id,
            $status
        ){              
            return array(
                'id' => $id,
                'nome' => $nome,
                'path' => $path,
                'nome_do_arquivo' => $nome_do_arquivo,
                'data_do_upload' => $data_do_upload,
                'processo_id' => $processo_id,
                'usuario_id' => $usuario_id,                
                'status' => $status                
            );
        }

        public function quantidade(){
            return $this->db->count_all_results(self::$TABELA_DB);
        }

    }