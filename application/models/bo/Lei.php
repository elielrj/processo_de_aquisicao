<?php

require_once 'abstract_bo/AbstractBO.php';

class Lei extends AbstractBO
{
	private $numero;
	private $artigo;
	private $inciso;
	private $data;
	private $modalidade;

	public function __construct(
		$id,
		$status,
		$numero,
		$artigo,
		$inciso,
		$data,
		$modalidade
	)
	{
		parent::__construct($id, $status);
		$this->numero = $numero;
		$this->artigo = $artigo;
		$this->inciso = $inciso;
		$this->data = $this->load->library('Data', $data);
		$this->modalidade = $modalidade;
	}

	public function toString()
	{
		return
			'Art. ' . $this->artigo . '° ' .
			empty($this->inciso) ? '' : ('inciso ' . $this->inciso . ', ') .
				'Lei ' . $this->numero .
				$this->data->formatoDoBrasil();
	}
}
