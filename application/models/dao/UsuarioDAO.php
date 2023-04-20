<?php defined('BASEPATH') OR exit('No direct script access allowed');

    include('application/models/bo/Usuario.php');    
    include('I_Crud_DAO.php');
    
    class UsuarioDAO extends CI_Model implements I_Crud_DAO {
        
        public static $TABELA_DB = 'usuario';
       
        public function __construct(){
            parent::__construct();            
        }

        public function create($usuario){
            $this->db->insert(self::$TABELA_DB,$usuario);
        }

        public function retrive($indiceInicial,$mostrar){
           
            $resultado = $this->db->get(
                self::$TABELA_DB,
                $mostrar,
                $indiceInicial                
            ); 
 
            $listaDeUsuarios = array();

            foreach($resultado->result() as $linha){

                $usuario = new Usuario(
                    $linha->id,
                    $linha->email,
                    $linha->cpf,
                    $linha->senha,                    
                    $linha->status                    
                );

                array_push($listaDeUsuarios, $usuario);
           }

            return $listaDeUsuarios;
        }

        public function retriveId($id){
            
            $resultado = $this->db->get_where(
                self::$TABELA_DB,
                array('id'=> $id)
            );   
            
            foreach($resultado->result() as $linha){
                return new Usuario(
                    $linha->id,
                    $linha->email,
                    $linha->cpf,
                    $linha->senha,                    
                    $linha->status                    
                );
            }
        }

        public function update($usuario){

            $this->db->update(
                self::$TABELA_DB,
                $usuario, 
                array('id'=> $usuario->id)
            );
        }

        public function delete($id){
            return $this->db->delete(
                self::$TABELA_DB,
                array('id'=> $id));
        }

        public function count_rows( ){
            return $this->db->count_all_results(self::$TABELA_DB);
        }

        public function verificarEmail($where){

            $resultado = $this->db->get_where('usuario',$where);

            return $resultado->result();
        }

        public function verificarSenha($where){
            
            $resultado = $this->db->get_where('usuario',$where);   
            
            return $resultado->result();
        }

        public function retriveEmail($email){
            
            $resultado = $this->db->get_where(
                self::$TABELA_DB,
                array('email'=> $email)
            );

            foreach($resultado->result() as $linha){
                return new Usuario(
                    $linha->id,
                    $linha->email,
                    $linha->cpf,
                    $linha->senha,                    
                    $linha->status                    
                );
            }
        }

    }

    