<?php

require_once 'vendor/autoload.php';

use TCPDF;
class Tcpdf
{
	public function imprimir()
	{
		// create new PDF document
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		// add a page
		$pdf->AddPage();

		$pdf->

		//Close and output PDF document
		$pdf->Output('example_023.pdf', 'I');
	}
}
