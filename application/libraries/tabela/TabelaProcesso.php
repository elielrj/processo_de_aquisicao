<?php
defined('BASEPATH') or exit('No direct script access allowed');

include_once('TabelaPregao.php');

    class TabelaProcesso {

        private $ordem;

        /** Recebe um Array ou não no terceiro prâmetro, 
         * caso o processo esteja selecionado.
         * 
         * $data = array(
         *     'processo_selecionado' => $processo_completo,
         *       'processo_id' => $processoId,
         *  );
         */
        public function processo($processos, $ordem, $data)
        {
            $this->ordem = $ordem;
            $tabela = $this->linhaDeCabecalhoDoProcesso();

            foreach($processos as $processo)
            {
                $this->ordem++;
                
                if((!empty($data)) && $processo->id == $data['processo_id']){
                    $tabela .= $this->linhaDoProcesso($processo);
                    $tabelaPregao = new TabelaPregao();
                    $tabela .= $tabelaPregao->pregao($data);
                }else{
                   $tabela .= $this->linhaDoProcesso($processo); 
                }
                
            }
            return $tabela;
        }

        private function linhaDeCabecalhoDoProcesso()
        {
            return
                "<tr class='text-center'> 
                    <td>Ordem</td>
                    <td>Id</td>
                    <td>Objeto do Processo</td>
                    <td>Nup/Nud</td>
                    <td>Data do Processo</td>
                    <td>Chave de Acesso</td>
                    <td>Usuário</td>
                    <td>Status</td>
                    <td>Alterar</td>
                    <td>Excluir</td>               
                </tr>";
        }

        private function linhaDoProcesso($processo)
    {
       
            return
                "<tr class='text-center'>" .
                
                    $this->processoOrdem() .
                    $this->processoId($processo->id) .
                    $this->processoObjeto($processo->objeto, $processo->id) .
                    $this->processoNupNud($processo->nupNud) .
                    $this->processoDataDoProcesso($processo->dataDoProcesso) .
                    $this->processoChaveDeAcesso($processo->chaveDeAcesso) .
                    $this->processoDepartamento($processo->departamento) .
                    $this->processoStatus($processo->status) .
                    $this->processoAlterar($processo->id) .
                    $this->processoExcluir($processo->id) .
                                
                "</tr>";
        }

        private function processoOrdem()
        {
            return "<td>{$this->ordem}</td>";
        }
        
        private function processoId($id)
        {
            return "<td>{$id}</td>";
        }

        private function processoObjeto($objeto, $id)
        {
            return "<td><a href='" . base_url('index.php/PregaoController/listarProcesso/' . $id) . "'>{$objeto}</a></td>";
        }

        private function processoNupNud($nup_nud)
        {
            return "<td>{$nup_nud}</td>";
        }

        private function processoDataDoProcesso($data_do_processo)
        {
            return "<td>{$this->formatarData($data_do_processo)}</td>";
        }

        private function processoChaveDeAcesso($chave_de_acesso)
        {
            return "<td>{$chave_de_acesso}</td>";
        }

        private function processoDepartamento($departamento)
    {
       
            return "<td>{$departamento->nome}</td>";
        }

        private function processoStatus($status)
        {
            return "<td>" . ($status ? 'Ativo' : 'Inativo') . "</td>";
        }

        private function processoAlterar($id)
        {
            $link = "index.php/ProcessoController/alterar/{$id}";
            $value = "<a href='" . base_url($link) . "'>Alterar</a>";
            return "<td>{$value}</td>";
        }

        private function processoExcluir($id)
        {
            $link = "index.php/ProcessoController/deletar/{$id}";

            $value = "<a href='" . base_url($link) . "'>" . 'Excluir' . "</a>";

            return "<td>{$value}</td>";
        }

        public function formatarData($data)
        {
            return form_input(array(
                'type' => 'datetime', 
                'value' => (new DateTime($data))->format('d-m-Y H:m:s'), 
                'disabled' => 'disable',  
                'class' => 'text-center'
            ));
        }
    }