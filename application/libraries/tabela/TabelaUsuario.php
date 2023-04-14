<?php

    class TabelaUsuario {

        private $ordem;

        public function usuario($usuarios, $ordem)
        {
            $this->ordem = $ordem;
            $tabela = $this->linhaDeCabecalhoDoUsuario();

            foreach($usuarios as $usuario)
            {
                $this->ordem++;
                $tabela .= $this->linhaDoUsuario($usuario);
            }
            return $tabela;
        }

        private function linhaDeCabecalhoDoUsuario()
        {
            return
                "<tr class='text-center'> 
                    <td>Ordem</td>
                    <td>Id</td>
                    <td>Email</td>
                    <td>CPF</td>
                    <td>Senha</td>
                    <td>Alterar</td>
                    <td>Excluir</td>               
                </tr>";
        }

        private function linhaDoUsuario($usuario)
        {
            return
                "<tr class='text-center'>" .
                
                    $this->usuarioOrdem() .
                    $this->usuarioId($usuario['id']) .
                    $this->usuarioEmail($usuario['email']) .
                    $this->usuarioCpf($usuario['cpf']) .
                    $this->usuarioSenha($usuario['senha']) .
                    $this->usuarioAlterar($usuario['id']) .
                    $this->usuarioExcluir($usuario['id']) .
                                
                "</tr>";
        }

        private function usuarioOrdem()
        {
            return "<td>{$this->ordem}</td>";
        }
        
        private function usuarioId($id)
        {
            return "<td>{$id}</td>";
        }

        private function usuarioEmail($email)
        {
            return "<td>{$email}</td>";
        }

        private function usuarioCpf($cpf)
        {
            return "<td>{$cpf}</td>";
        }

        private function usuarioSenha($senha)
        {
            return "<td>{$senha}</td>";
        }

        private function usuarioAlterar($id)
        {
            $link = "index.php/usuario/alterar/{$id}";
            $value = "<a href='" . base_url($link) . "'>Alterar</a>";
            return "<td>{$value}</td>";
        }

        private function usuarioExcluir($id)
        {
            $link = "index.php/usuario/deletar/{$id}";

            $value = "<a href='" . base_url($link) . "'>" . 'Excluir' . "</a>";

            return "<td>{$value}</td>";
        }

    }