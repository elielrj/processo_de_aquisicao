<?php

require_once 'AbstractBO.php';

class Processo extends AbstractBO
{
	private $objeto;
	private $numero;
	private $dataHora;
	private $chave;
	private $completo;
	private $lei;
	private $departamento;
	private $listaDeArtefatos;
	private $tipo;
	private $listaDeAndamentos;


	public function __construct(
		$id,
		$status,
		$objeto,
		$numero,
		$dataHora,
		$chave,
		$completo,
		$lei,
		$departamento,
		$listaDeArtefatos,
		$tipo,
		$listaDeAndamentos
	)
	{
		parent::__construct($id, $status);
		$this->objeto = $objeto;
		$this->numero = $numero;
		$this->dataHora = $dataHora;
		$this->chave = $chave;
		$this->completo = $completo;
		$this->lei = $lei;
		$this->departamento = $departamento;
		$this->listaDeArtefatos = $listaDeArtefatos;
		$this->tipo = $tipo;
		$this->listaDeAndamentos = $listaDeAndamentos;
	}

	public function toString()
	{
		return
			'Processo de ' . $this->tipo->toString() .
			'Nup/Nud ' . $this->numero .
			', ' . $this->lei->toString();
	}
}
