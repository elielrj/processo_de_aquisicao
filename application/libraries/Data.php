<?php

class Data
{
	const DATE_TIME_ZONE = 'America/Sao_Paulo';
	const FORMATO_D_M_A = 'd-m-Y';
	const FORMATO_A_M_D_MYSQL = 'Y-m-d';

	private $data;

	public function __construct(
		$dateString = 'now',
		$dateTimeZone = self::DATE_TIME_ZONE
	)
	{
		$this->data = new DateTime(
			$dateString,
			new DateTimeZone($dateTimeZone)
		);
	}

	public function formatoDoBrasil()
	{
		return ($this->data)->format(self::FORMATO_D_M_A);
	}
	public function formatoDoMySQL()
	{
		return ($this->data)->format(self::FORMATO_A_M_D_MYSQL);
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
