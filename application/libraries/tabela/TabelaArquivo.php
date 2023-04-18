<?php

    class TabelaArquivo {

        private $ordem;

        public function arquivo($arquivos, $ordem)
        {
            $this->ordem = $ordem;
            $tabela = $this->linhaDeCabecalhoDoArquivo();

            foreach($arquivos as $arquivo)
            {
                $this->ordem++;
                $tabela .= $this->linhaDoArquivo($arquivo);
            }
            return $tabela;
        }

        private function linhaDeCabecalhoDoArquivo()
        {
            return
                "<tr class='text-center'> 
                    <td>Ordem</td>
                    <td>Id</td>
                    <td>nome</td>
                    <td>Path</td>
                    <td>Nome do Arquivo</td>
                    <td>Data do Upload</td>
                    <td>Processo</td>
                    <td>Usuario</td>
                    <td>Alterar</td>
                    <td>Excluir</td>               
                </tr>";
        }

        private function linhaDoArquivo($arquivo)
        {
            return
                "<tr class='text-center'>" .
                
                    $this->arquivoOrdem() .
                    $this->arquivoId($arquivo['id']) .
                    $this->arquivoNome($arquivo['nome']) .
                    $this->arquivoPath($arquivo['path']) .
                    $this->arquivoNomeDoArquivo($arquivo['nome_do_arquivo']) .
                    $this->arquivoDataDoUpload($arquivo['data_do_upload']) .
                    $this->arquivoProcessoId($arquivo['processo_id']) .
                    $this->arquivoUsuarioId($arquivo['usuario_id']) .
                    $this->arquivoAlterar($arquivo['id']) .
                    $this->arquivoExcluir($arquivo['id']) .
                                
                "</tr>";
        }

        private function arquivoOrdem()
        {
            return "<td>{$this->ordem}</td>";
        }
        
        private function arquivoId($id)
        {
            return "<td>{$id}</td>";
        }

        private function arquivoNome($nome)
        {
            return "<td>{$nome}</td>";
        }

        private function arquivoPath($path)
        {
            return "<td>{$path}</td>";
        }

        private function arquivoNomeDoArquivo($nome_do_arquivo)
        {
            return "<td>{$nome_do_arquivo}</td>";
        }

        private function arquivoDataDoUpload($data_do_upload)
        {
            return "<td>{$data_do_upload}</td>";
        }

        private function arquivoProcessoId($processo_id)
        {
            return "<td>{$processo_id}</td>";
        }

        private function arquivoUsuarioId($usuario_id)
        {
            return "<td>{$usuario_id}</td>";
        }

        private function arquivoAlterar($id)
        {
            $link = "index.php/arquivo/alterar/{$id}";
            $value = "<a href='" . base_url($link) . "'>Alterar</a>";
            return "<td>{$value}</td>";
        }

        private function arquivoExcluir($id)
        {
            $link = "index.php/arquivo/deletar/{$id}";

            $value = "<a href='" . base_url($link) . "'>" . 'Excluir' . "</a>";

            return "<td>{$value}</td>";
        }

    }