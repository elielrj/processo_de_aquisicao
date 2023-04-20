<?php

    class TabelaProcesso {

        private $ordem;

        public function processo($processos, $ordem)
        {
            $this->ordem = $ordem;
            $tabela = $this->linhaDeCabecalhoDoProcesso();

            foreach($processos as $processo)
            {
                $this->ordem++;
                $tabela .= $this->linhaDoProcesso($processo);
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
                    $this->processoId($processo['id']) .
                    $this->processoObjeto($processo['objeto']) .
                    $this->processoNupNud($processo['nup_nud']) .
                    $this->processoDataDoProcesso($processo['data_do_processo']) .
                    $this->processoChaveDeAcesso($processo['chave_de_acesso']) .
                    $this->processoUsuario($processo['usuario_id']) .
                    $this->processoStatus($processo['status']) .
                    $this->processoAlterar($processo['id']) .
                    $this->processoExcluir($processo['id']) .
                                
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

        private function processoObjeto($objeto)
        {
            return "<td>{$objeto}</td>";
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

        private function processoUsuario($usuario)
        {
            return "<td>{$usuario_id['email']}</td>";
        }

        private function processoStatus($status)
        {
            return "<td>" . ($status ? 'Ativo' : 'Inativo') . "</td>";
        }

        private function processoAlterar($id)
        {
            $link = "index.php/processo/alterar/{$id}";
            $value = "<a href='" . base_url($link) . "'>Alterar</a>";
            return "<td>{$value}</td>";
        }

        private function processoExcluir($id)
        {
            $link = "index.php/processo/deletar/{$id}";

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