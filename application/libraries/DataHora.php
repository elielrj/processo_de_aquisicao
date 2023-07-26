<?php

class DataHora
{
	const DATE_TIME_ZONE = 'America/Sao_Paulo';
	const FORMATO_D_M_A_H_M_S =  'd-m-Y H:i:s';
	const FORMATO_A_M_D__H_M_SP_MYSQL = 'Y-m-d H:i:sP';

	private $dataHora;

	public function __construct(
		$dateString = 'now',
		$dateTimeZone = self::DATE_TIME_ZONE
	)
	{
		$this->dataHora = new DateTime(
			$dateString,
			new DateTimeZone($dateTimeZone)
		);
	}

	public function formatoDoBrasil()
	{
		return ($this->dataHora)->format(self::FORMATO_D_M_A_H_M_S);
	}
	public function formatoDoMySQL()
	{
		return ($this->dataHora)->format(self::FORMATO_A_M_D__H_M_SP_MYSQL);
	}
	function __get($key)
	{
		return $this->$key;
	}

	function __set($key, $value)
	{
		$this->$key = $value;
	}
}
