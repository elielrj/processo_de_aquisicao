<?php

defined('BASEPATH') or exit('No direct script access allowed');


include_once('InterfaceBO.php');


class Lei implements InterfaceBO
{

	private $id;
	private $numero;
	private $artigo;
	private $inciso;
	private $data;
	private $modalidade;
	private $status;

	public function __construct(
		$id,
		$numero,
		$artigo,
		$inciso,
		$data,
		$modalidade,
		$status = true
	)
	{
		$this->id = $id;
		$this->numero = $numero;
		$this->artigo = $artigo;
		$this->inciso = $inciso;
		$this->data = $data;
		$this->modalidade = $modalidade;
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

	public function toString()
	{

		include_once 'application/libraries/Data.php';
		$data = new Data($this->data);

		$art = ($this->artigo != "") ? (", Art. " . $this->artigo) : '';
		$inc = ($this->inciso != "") ? (", Inc. " . $this->inciso) : '';
		$dat = ", de " . $data->formatoDoBrasil();

		return $this->numero . $art . $inc . $dat;
	}

	public function array()
	{
		$this->load->helper('data');

		return array(
			'id' => $this->id ?? null,
			'numero' => $this->numero,
			'artigo' => $this->artigo,
			'inciso' => $this->inciso,
			'data' => $this->data->dataHoraNoFormatoMySQL(),
			'modalidade_id' => $this->modalidade->id,
			'status' => $this->status
		);
	}

}
