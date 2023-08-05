<?php

require_once 'abstract_dao/AbstractDAO.php';

class UsuarioDAO extends AbstractDAO
{
	const TABELA_USUARIO = 'usuario';

	public function __construct()
	{
		parent::__construct();
	}

	public function criar($array)
	{
		$this->db->insert(
			self::TABELA_USUARIO,
			$array
		);
	}

	public function atualizar($array, $where)
	{
		$this->db->update(
			self::TABELA_USUARIO,
			$array,
			$where
		);
	}

	public function buscarPorId($id)
	{
		return
			$this->db->get_where(
				self::TABELA_USUARIO,
				[ID => $id]
			);
	}

	public function buscarTodosAtivos($inicio, $fim)
	{
		return
			$this->db
				->order_by(DATA_HORA, DIRECTIONS_DESC)
				->where([STATUS => true])
				->get(self::TABELA_USUARIO, $inicio, $fim);
	}

	public function buscarTodosInativos($inicio, $fim)
	{
		return
			$this->db
				->order_by(DATA_HORA, DIRECTIONS_DESC)
				->where([STATUS => false])
				->get(self::TABELA_USUARIO, $inicio, $fim);
	}


	public function buscarTodosStatus($inicio, $fim)
	{
		return
			$this->db
				->order_by(ID, DIRECTIONS_ASC)
				->get(self::TABELA_USUARIO, $inicio, $fim);
	}

	public function buscarAonde($where)
	{
		return
			$this->db
				->where($where)
				->get(self::TABELA_USUARIO);
	}

	public function excluirDeFormaPermanente($id)
	{
		$this->db->delete(
			self::TABELA_USUARIO,
			[ID => $id]);
	}

	public function excluirDeFormaLogica($id)
	{
		$linhaArrayList = $this->buscarPorId($id);

		foreach ($linhaArrayList as $linha) {
			$linha->status = false;
		}

		$this->db->update($linhaArrayList);
	}

	public function contarRegistrosAtivos()
	{
		return $this->db
			->where([STATUS => true])
			->count_all_results(self::TABELA_USUARIO);
	}

	public function contarRegistrosInativos()
	{
		return $this->db
			->where([STATUS => false])
			->count_all_results(self::TABELA_USUARIO);
	}

	public function contarTodosOsRegistros()
	{
		return $this->db
			->count_all_results(self::TABELA_USUARIO);
	}

	public function options()
	{
		$options = [];

		foreach ($this->buscarTodosAtivos(null, null) as $usuario) {
			$options += [$usuario->id => $usuario->nome];
		}
		return $options;
	}

	/**
	 * Login
	 */
	public function emailExiste($email)
	{
		$array = $this->DAO->buscarOnde(self::TABELA_USUARIO, array(EMAIL => $email));

		return ($array->num_rows() == 1);
	}

	public function senhaEstaCorreta($email, $senha)
	{
		$array = $this->DAO->buscarOnde(self::TABELA_USUARIO, array(EMAIL => $email, SENHA => $senha));

		return ($array->num_rows() == 1);
	}

	public function buscarDadosDoUsuarioLogado($email, $senha)
	{
		$where = array(EMAIL => $email, SENHA => $senha);

		$array = $this->DAO->buscarOnde(self::TABELA_USUARIO, $where);

		foreach ($array->result() as $linha) {

			$this->session->set_userdata(
				array(
					SESSION_ID => $linha->id,
					SESSION_NOME_DE_GUERRA => $linha->nome_de_guerra,
					SESSION_NOME_COMPLETO => $linha->nome_completo,
					SESSION_EMAIL => $linha->email,
					SESSION_CPF => $linha->cpf,
					SESSION_SENHA => $linha->senha,
					SESSION_DEPARTAMENTO_ID => $linha->departamento_id,
					SESSION_DEPARTAMENTO_NOME => ($this->DepartamentoDAO->buscarPorId($linha->departamento_id))->sigla,
					SESSION_STATUS => $linha->status,
					SESSION_HIERARQUIA_ID => $linha->hierarquia_id,
					SESSION_FUNCAO_ID => $linha->funcao_id,
					SESSION_HIERARQUIA_SIGLA => ($this->HierarquiaDAO->buscarPorId($linha->hierarquia_id)->sigla),
					SESSION_FUNCAO_NIVEL_DE_ACESSO => ($this->FuncaoDAO->buscarPorId($linha->funcao_id)->nivelDeAcesso->nome()),
				)
			);
		}
	}

	public function contarTodosOsRegistrosAonde($where)
	{
		return $this->db
			->where($where)
			->count_all_results((self::TABELA_USUARIO));
	}

	public function recuperar($id)
	{
		$linhaArrayList = $this->buscarPorId($id);

		foreach ($linhaArrayList as $linha) {
			$linha->status = true;
		}

		$this->db->update($linhaArrayList);
	}
}
