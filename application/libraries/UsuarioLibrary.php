<?php

defined('BASEPATH') or exit('No direct script access allowed');

class UsuarioLibrary {

    private $ordem;
    private $controller = 'UsuarioController';

    public function listar($usuarios, $ordem) {
        $this->ordem = $ordem;
        $tabela = $this->linhaDeCabecalhoDoUsuario();

        foreach ($usuarios as $usuario) {
            $this->ordem++;
            $tabela .= $this->linhaDoUsuario($usuario);
        }
        return $tabela;
    }

    private function linhaDeCabecalhoDoUsuario() {
        return from_array_to_table_row_with_td([
            'Ordem',
			'Nome de Guerra',
			'Nome Completo',
            'Email',
            'CPF',
            'Senha',
            'Departamento',
            'Status',
            'Alterar',
            'Excluir'
        ]);
    }

    private function linhaDoUsuario($usuario) {
        return from_array_to_table_row([
            td_ordem($this->ordem) ,
            td_value($usuario->nomeDeGuerra) ,
            td_value($usuario->nomeCompleto) ,
            td_value($usuario->email) ,
            td_value($usuario->cpf) ,
            td_value($usuario->senha) ,
            td_value($usuario->departamento->sigla) ,
            td_status($usuario->status) ,
            td_alterar($this->controller, $usuario->id), 
            td_excluir($this->controller, $usuario->id), 
        ]);
    }  

}
