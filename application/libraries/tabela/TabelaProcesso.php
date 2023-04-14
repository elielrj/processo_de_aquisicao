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
                    $this->processoNupNud($processo['nupNud']) .
                    $this->processoDataDoProcesso($processo['dataDoProcesso']) .
                    $this->processoChaveDeAcesso($processo['chaveDeAcesso']) .
                    $this->processoUsuario($processo['usuarioId']) .
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

        private function processoNupNud($nupNud)
        {
            return "<td>{$nupNud}</td>";
        }

        private function processoDataDoProcesso($dataDoProcesso)
        {
            return "<td>{$this->formatarData($dataDoProcesso)}</td>";
        }

        private function processoChaveDeAcesso($chaveDeAcesso)
        {
            return "<td>{$chaveDeAcesso}</td>";
        }

        private function processoUsuario($usuarioId)
        {
            return "<td>{$usuarioId}</td>";
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