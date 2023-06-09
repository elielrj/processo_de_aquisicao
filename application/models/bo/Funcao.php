<?php

defined('BASEPATH') or exit('No direct script access allowed');

include_once('InterfaceBO.php');
include_once('nivel_de_acesso/NivelDeAcesso.php');
include_once('nivel_de_acesso/Leitor.php');
include_once('nivel_de_acesso/Escritor.php');
include_once('nivel_de_acesso/AprovadorFiscAdm.php');
include_once('nivel_de_acesso/AprovadorOd.php');
include_once('nivel_de_acesso/Executor.php');
include_once('nivel_de_acesso/Conformador.php');
include_once('nivel_de_acesso/Administrador.php');
include_once('nivel_de_acesso/Root.php');

class Funcao implements InterfaceBO, NivelDeAcesso
{

	private $id;
	private $nome;
	private $nivelDeAcesso;
	private $status;

	public function __construct(
		$id,
		$nome,
		$nivelDeAcesso,
		$status = true
	)
	{
		$this->id = $id;
		$this->nome = $nome;
		$this->nivelDeAcesso = $nivelDeAcesso;
		$this->status = $status;
	}

	function __get($key)
	{
		return $this->$key;
	}

	function __set($key, $value)
	{
		$this->$key = $value;
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

	public function nome()
	{
		return $this->nivelDeAcesso->nome();
	}

	public function nivel()
	{
		return $this->nivelDeAcesso->nivel();
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
}
