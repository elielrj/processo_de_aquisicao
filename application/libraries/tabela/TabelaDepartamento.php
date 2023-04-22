<?php
defined('BASEPATH') or exit('No direct script access allowed');
    class TabelaDepartamento {

        private $ordem;

        public function departamento($departamentos, $ordem)
        {
            $this->ordem = $ordem;
            $tabela = $this->linhaDeCabecalhoDoDepartemento();

            foreach($departamentos as $departamento)
            {
                $this->ordem++;
                $tabela .= $this->linhaDoDepartamento($departamento);
            }
            return $tabela;
        }

        private function linhaDeCabecalhoDoDepartemento()
        {
            return
                "<tr class='text-center'> 
                    <td>Ordem</td>
                    <td>Id</td>
                    <td>Nome</td>
                    <td>Sigla</td>
                    <td>Status</td>
                    <td>Alterar</td>
                    <td>Excluir</td>               
                </tr>";
        }

        private function linhaDoDepartamento($departamento)
        {
            return
                "<tr class='text-center'>" .
                
                    $this->departamentoOrdem() .
                    $this->departamentoId($departamento->id) .
                    $this->departamentoNome($departamento->nome) .
                    $this->departamentoSigla($departamento->sigla) .
                    $this->departamentoStatus($departamento->status) .
                    $this->departamentoAlterar($departamento->id) .
                    $this->departamentoExcluir($departamento->id) .
                                
                "</tr>";
        }

        private function departamentoOrdem()
        {
            return "<td>{$this->ordem}</td>";
        }
        
        private function departamentoId($id)
        {
            return "<td>{$id}</td>";
        }

        private function departamentoNome($nome)
        {
            return "<td>{$nome}</td>";
        }

        private function departamentoSigla($sigla)
        {
            return "<td>{$sigla}</td>";
        }

        private function departamentoStatus($status)
        {
            return "<td>" . ($status ? 'Ativo' : 'Inativo') . "</td>";
        }

        private function departamentoAlterar($id)
        {
            $link = "index.php/DepartamentoController/alterar/{$id}";
            $value = "<a href='" . base_url($link) . "'>Alterar</a>";
            return "<td>{$value}</td>";
        }

        private function departamentoExcluir($id)
        {
            $link = "index.php/DepartamentoController/deletar/{$id}";

            $value = "<a href='" . base_url($link) . "'>" . 'Excluir' . "</a>";

            return "<td>{$value}</td>";
        }

    }