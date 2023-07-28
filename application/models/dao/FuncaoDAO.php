<?php

require_once 'abstract_dao/AbstractDAO.php';
class FuncaoDAO extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function criar($objeto)
    {
        $this->DAO->criar(TABLE_FUNCAO, $objeto->array());
    }

    public function buscarTodos($inicial, $final)
    {
        $array = $this->DAO->buscarTodos(TABLE_FUNCAO, $inicial, $final);

        return $this->criarLista($array);
    }

    public function buscarTodosDesativados($inicial, $final)
    {
        $array = $this->DAO->buscarTodosDesativados(TABLE_FUNCAO, $inicial, $final);

        return $this->criarLista($array);
    }

    public function buscarPorId($funcaoId)
    {
        $array = $this->DAO->buscarPorId(TABLE_FUNCAO, $funcaoId);

        return $this->toObject($array->result()[0]);
    }

    public function buscarOnde($key, $value)
    {
        $array = $this->DAO->buscarOnde(TABLE_FUNCAO, array($key => $value));

        return $this->criarLista($array->result());
    }

    public function atualizar($funcao)
    {
        $this->DAO->atualizar(TABLE_FUNCAO, $funcao->array());
    }


    public function deletar($funcao)
    {
        $this->DAO->deletar(TABLE_FUNCAO, $funcao->array());
    }

    public function contar()
    {
        return $this->DAO->contar(TABLE_FUNCAO);
    }

    public function contarDesativados()
    {
        return $this->DAO->contarDesativados(TABLE_FUNCAO);
    }

    private function toObject($arrayList)
    {
        return new Funcao(
            isset($arrayList->id)
            ? $arrayList->id
            : (isset($arrayList['id']) ? $arrayList['id'] : null),
            isset($arrayList->nome)
            ? $arrayList->nome
            : (isset($arrayList['nome']) ? $arrayList['nome'] : null),
            isset($arrayList->nivel_de_acesso)
            ? Funcao::selecionarNivelDeAcesso($arrayList->nivel_de_acesso)
            : (isset($arrayList['nivel_de_acesso']) ? Funcao::selecionarNivelDeAcesso($arrayList['nivel_de_acesso']) : null),
            isset($arrayList->status)
            ? $arrayList->status
            : (isset($arrayList['status']) ? $arrayList['status'] : null)
        );
    }

    private function criarLista($array)
    {
        $listaDefuncao = array();

        foreach ($array->result() as $linha) {

            $funcao = $this->toObject($linha);

            array_push($listaDefuncao, $funcao);
        }

        return $listaDefuncao;
    }

    public function options()
    {
        $funcoes = $this->buscarTodos(null, null);

        $options = [];

        if (isset($funcoes)) {

            foreach ($funcoes as $funcao) {

                $options += [$funcao->id => $funcao->nome];

            }
        }
        return $options;
    }

	public static function selecionarNivelDeAcesso($nome)
	{
		switch ($nome) {
			case Leitor::NOME:
				return new Leitor();
			case Escritor::NOME:
				return new Escritor();
			case AprovadorFiscAdm::NOME:
				return new AprovadorFiscAdm();
			case AprovadorOd::NOME:
				return new AprovadorOd();
			case Executor::NOME:
				return new Executor();
			case Conformador::NOME:
				return new Conformador();
			case Administrador::NOME:
				return new Administrador();
			case Root::NOME:
				return new Root();
		}
	}

	public function array()
	{
		return array(
			'id' => $this->id,
			'nome' => $this->nome,
			'nivel_de_acesso' => $this->nivelDeAcesso->nome(),
			'status' => $this->status
		);
	}
}
