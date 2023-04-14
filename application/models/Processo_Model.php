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
                    'nupNud' => $processo['nupNud'],
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
                    $linha->nupNud,
                    $linha->dataDoProcesso,
                    $linha->chaveDeAcesso,
                    $linha->usuarioId                    
                );

                array_push($listaDeProcessos, $processo);
           }
            return $listaDeProcessos;
        }

        public function processo(
            $id,
            $objeto,
            $nupNud,
            $dataDoProcesso,
            $chaveDeAcesso,
            $usuarioId
            ){       
            
        
            return array(
                'id' => $id,
                'objeto' => $objeto,
                'nupNud' => $nupNud,
                'dataDoProcesso' => $dataDoProcesso,
                'chaveDeAcesso' => $chaveDeAcesso,
                'usuarioId' => $usuarioId                
            );
        }

        public function quantidade(){
            return $this->db->count_all_results(self::$TABELA_DB);
        }

    }