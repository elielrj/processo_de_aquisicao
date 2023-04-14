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

        public function retrive($indiceInicial,$mostrar){
           
            $resultado = $this->db->get(
                self::$TABELA_DB,
                $mostrar,
                $indiceInicial                
            ); 
 
            return $this->montarObjetoUsuario($resultado->result());
        }

        public function retriveId($id){
            
            $resultado = 
            $this->db->get_where(
                self::$TABELA_DB,
                array('id'=> $id)
            );   
            
            return $this->montarObjetoUsuario($resultado->result());
        }

        public function update($usuario){

            $this->db->update(
                self::$TABELA_DB,
                $usuario, 
                array('id'=> $usuario['id'])
            );
        }

        public function delete($id){
            return $this->db->delete(
                self::$TABELA_DB,
                array('id'=> $id));
        }

        public function montarObjetoUsuario($result){

            $listaDeUsuarios = array();

            foreach($result as $linha){
                $usuario = $this->usuario(
                    $linha->id,
                    $linha->email,
                    $linha->cpf,
                    $linha->senha                    
                );

                array_push($listaDeUsuarios, $usuario);
           }
            return $listaDeUsuarios;
        }

        public function usuario(
            $id,
            $email,
            $cpf,
            $senha
            ){       
            
        
            return array(
                'id' => $id,
                'email' => $email,
                'cpf' => $cpf,
                'senha' => $senha              
            );
        }

        public function quantidade(){
            return $this->db->count_all_results(self::$TABELA_DB);
        }

    }