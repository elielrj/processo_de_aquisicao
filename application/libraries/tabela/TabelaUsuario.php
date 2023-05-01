<?php

defined('BASEPATH') or exit('No direct script access allowed');

class TabelaUsuario {

    private $ordem;

    public function usuario($usuarios, $ordem) {
        $this->ordem = $ordem;
        $tabela = $this->linhaDeCabecalhoDoUsuario();

        foreach ($usuarios as $usuario) {
            $this->ordem++;
            $tabela .= $this->linhaDoUsuario($usuario);
        }
        return $tabela;
    }

    private function linhaDeCabecalhoDoUsuario() {
        return
                "<tr class='text-center'> 
                    <td>Ordem</td>
                    <td>Email</td>
                    <td>CPF</td>
                    <td>Senha</td>
                    <td>Departamento</td>
                    <td>Status</td>
                    <td>Alterar</td>
                </tr>";
    }

    private function linhaDoUsuario($usuario) {
        return
                "<tr class='text-center'>" .
                $this->ordem() .
                $this->email($usuario->email) .
                $this->cpf($usuario->cpf) .
                $this->senha($usuario->senha) .
                $this->departamento($usuario->departamento) .
                $this->status($usuario->status) .
                $this->alterar($usuario->status, $usuario->id) .
                "</tr>";
    }

    private function ordem() {
        return "<td>{$this->ordem}</td>";
    }

    private function id($id) {
        return "<td>{$id}</td>";
    }

    private function email($email) {
        return "<td class='text-left'>{$email}</td>";
    }

    private function cpf($cpf) {
        return "<td>{$cpf}</td>";
    }

    private function senha($senha) {
        return "<td>******</td>";
    }

    private function departamento($departamento) {
        return "<td>{$departamento->nome}</td>";
    }

    private function status($status) {
        return "<td>" . ($status ? 'Ativar' : 'Inativo') . "</td>";
    }

    private function alterar($status, $id) {
        if ($status) {
            return $this->desativar($id);
        } else {
            return $this->ativar($id);
        }
    }

    private function ativar($id) {
        $link = "index.php/UsuarioController/ativar/{$id}";
        $value = "<a href='" . base_url($link) . "'>Ativar</a>";
        return "<td>{$value}</td>";
    }

    private function desativar($id) {
        $link = "index.php/UsuarioController/desativar/{$id}";

        $value = "<a href='" . base_url($link) . "'>" . 'Desativar' . "</a>";

        return "<td>{$value}</td>";
    }

}
