<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once '../abstract_bo/AbstractBO.php';
require_once 'nivel_de_acesso/InterfaceNivelDeAcesso.php';

class Funcao extends AbastractBO implements InterfaceNivelDeAcesso
{
	private $descricao;
	private $nivelDeAcesso;

	public function __construct(
		$id,
		$status,
		$descricao,
		$nivelDeAcesso
	)
	{
		parent::__construct($id, $status);
		$this->descricao = $descricao;
		$this->nivelDeAcesso = $nivelDeAcesso;
	}

	public function nome()
	{
		return $this->nivelDeAcesso->nome();
	}
}
