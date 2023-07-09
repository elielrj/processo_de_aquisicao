<?php

namespace helper;

use DateTime;
use DateTimeZone;

class Tempo
{
	private const DATE_TIME_ZONE = 'America/Sao_Paulo';
	private $dataHora;

	public function __construct(
		$dateString = 'now',
		$dateTimeZone = self::DATE_TIME_ZONE
	)
	{
		$this->dataHora = new DateTime(
			$dateString,
			new DateTimeZone($dateTimeZone));
	}

	public function now()
	{
		return new Tempo();
	}

	public function dataHoraNoFormatoMySQL()
	{
		return $this->dataHora->format('Y-m-d H:i:sP');
	}

	public function dataHoraNoFormatoBrasileiro()
	{
		return ($this->dataHora)->format('d-m-Y H:i:s');
	}

	public function dataNoFormatoBrasileiro()
	{
		return ($this->dataHora)->format('d-m-Y');
	}

}
