<?php
defined('BASEPATH') or exit('No direct script access allowed');

    class TabelaTipoDeLicitacao {

        private $ordem;

        public function tipoDeLicitacao($tiposDeLicitacoes, $ordem)
        {
            $this->ordem = $ordem;
            $tabela = $this->linhaDeCabecalhoDeTipoDeLicitacao();

            foreach($tiposDeLicitacoes as $tipoDeLicitacao)
            {
                $this->ordem++;
                
                $tabela .= $this->linhaDeTipoDeLicitacao($tipoDeLicitacao);                
            }
            return $tabela;
        }

        private function linhaDeCabecalhoDeTipoDeLicitacao()
        {
            return
                "<tr class='text-center'> 
                    <td>Ordem</td>
                    <td>Id</td>
                    <td>Nome</td>
                    <td>Lei</td>
                    <td>Data da Lei</td>
                    <td>Status</td>
                    <td>Alterar</td>
                    <td>Excluir</td>               
                </tr>";
        }

        private function linhaDeTipoDeLicitacao($tipoDeLicitacao)
    {
       
            return
                "<tr class='text-center'>" .
                
                    $this->tipoDeLicitacaoOrdem() .
                    $this->tipoDeLicitacaoId($tipoDeLicitacao->id) .
                    $this->tipoDeLicitacaoNome($tipoDeLicitacao->nome) .
                    $this->tipoDeLicitacaoLei($tipoDeLicitacao->lei) .
                    $this->tipoDeLicitacaoDataDaLei($tipoDeLicitacao->dataDaLei) .
                    $this->tipoDeLicitacaoStatus($tipoDeLicitacao->status) .
                    $this->tipoDeLicitacaoAlterar($tipoDeLicitacao->id) .
                    $this->tipoDeLicitacaoExcluir($tipoDeLicitacao->id) .
                                
                "</tr>";
        }

        private function tipoDeLicitacaoOrdem()
        {
            return "<td>{$this->ordem}</td>";
        }
        
        private function tipoDeLicitacaoId($id)
        {
            return "<td>{$id}</td>";
        }

        private function tipoDeLicitacaoNome($nome)
        {
            return "<td>{$nome}</td>";
        }

        private function tipoDeLicitacaoLei($lei)
        {
            return "<td>{$lei}</td>";
        }

        private function tipoDeLicitacaoDataDalei($dataDaLei)
        {
            return "<td>{$this->formatarData($dataDaLei)}</td>";
        }

        private function tipoDeLicitacaoStatus($status)
        {
            return "<td>" . ($status ? 'Ativo' : 'Inativo') . "</td>";
        }

        private function tipoDeLicitacaoAlterar($id)
        {
            $link = "index.php/TipoDeLicitacaoController/alterar/{$id}";
            $value = "<a href='" . base_url($link) . "'>Alterar</a>";
            return "<td>{$value}</td>";
        }

        private function tipoDeLicitacaoExcluir($id)
        {
            $link = "index.php/TipoDeLicitacaoController/deletar/{$id}";

            $value = "<a href='" . base_url($link) . "'>" . 'Excluir' . "</a>";

            return "<td>{$value}</td>";
        }

        public function formatarData($data)
        {
            return form_input(array(
                'type' => 'datetime', 
                'value' => (new DateTime($data))->format('d-m-Y'), 
                'disabled' => 'disable',  
                'class' => 'text-center'
            ));
        }
    }