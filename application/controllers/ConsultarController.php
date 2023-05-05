<?php

defined('BASEPATH') or exit('No direct script access allowed');

class ConsultarController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->exibir();
    }


    private function exibir()
    {
        $data = $this->input->post();

        $numero = $data['numero'];
        $chave = $data['chave'];

        if($this->permitirAcesso($numero,$chave)){

            $this->session->set_userdata('consultar_validado', true);

            $processo = $this->buscarProcesso($numero, $chave);

            $tabela = $this->tabela->processo_imprimir($processo);

            $this->load->view('index', [
                'titulo' => 'Processo: ' . $processo->tipo->nome,
                'tabela' => $tabela,
                'pagina' => 'exibir.php',
            ]);
            
        }
        
    }

    private function buscarProcesso($numero,$chave)
    {
        return $this->ConsultarDAO->buscarPorNumeroChave($numero, $chave);
    }

    private function permitirAcesso($numero,$chave)
    {
        $where = array(
            'numero' => $numero,
            'chave' => $chave,
        );

        return $this->ConsultarDAO->permitirAcesso($where);
    }

}