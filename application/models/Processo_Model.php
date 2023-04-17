<?php defined('BASEPATH') OR exit('No direct script access allowed');

    class Processo_Model extends CI_Model {
        
        public static $TABELA_DB = 'processo';
        
        public function __construct(){
            parent::__construct();
        }
        
        public function criar($processo){
            $this->db->insert(
                self::$TABELA_DB, 
                $processo);
        }

        public function retrive($indiceInicial,$mostrar){
           
            $resultado = $this->db->get(
                self::$TABELA_DB,
                $mostrar,
                $indiceInicial                
            ); 
 
            return $this->montarObjetoProcesso($resultado->result());
        }

        public function retriveId($id){
            
            $resultado = 
            $this->db->get_where(
                self::$TABELA_DB,
                array('id'=> $id)
            );   
            
            return $this->montarObjetoProcesso($resultado->result());
        }

        public function update($processo){

            $this->db->update(
                self::$TABELA_DB,
                array(
                    'objeto' => $processo['objeto'],
                    'nup_nud' => $processo['nup_nud'],
                ), 
                array('id'=> $processo['id'])
            );
        }

        public function delete($id){
            return $this->db->delete(
                self::$TABELA_DB,
                array('id'=> $id));
        }

        public function montarObjetoProcesso($result){

            $listaDeProcessos = array();

            foreach($result as $linha){
                $processo = $this->processo(
                    $linha->id,
                    $linha->objeto,
                    $linha->nup_nud,
                    $linha->data_do_processo,
                    $linha->chave_de_acesso,
                    $linha->usuario_id,                    
                    $linha->status                    
                );

                array_push($listaDeProcessos, $processo);
           }
            return $listaDeProcessos;
        }

        public function processo(
            $id,
            $objeto,
            $nup_nud,
            $data_do_processo,
            $chave_de_acesso,
            $usuario_id,
            $status
            ){       
            
        
            return array(
                'id' => $id,
                'objeto' => $objeto,
                'nup_nud' => $nup_nud,
                'data_do_processo' => $data_do_processo,
                'chave_de_acesso' => $chave_de_acesso,
                'usuario_id' => $usuario_id,                
                'status' => $status                
            );
        }

        public function quantidade(){
            return $this->db->count_all_results(self::$TABELA_DB);
        }

       /* public function selectProcesso(){            

            $select = [];

            foreach($this->retrive(null,null) as $value){
                
                if(isset($value)){
                    $processo = array($value['id'] => $value['objeto'] . "(" . $value['nup_nud'] . ")");

                $select += $processo;
                }
            }

            return $select;
        }*/
    }