<?php

require_once('vendor/autoload.php');

use PDFMerger\PDFMerger;

class Pdf
{
	public function __construct()
	{
		//include_once 'vendor/PDFMerger/PDFMerger.php';
	}

	public function imprimir($listaDePath, $nomeDoArquivoEmPdf)
	{
		$pdfMerger = new PDFMerger;

		foreach ($listaDePath as $path) {
			if (file_exists($path)) {
				$pdfMerger->addPDF($path);
			}
		}
		
		$pdfMerger->merge('download', clear_strings($nomeDoArquivoEmPdf));
	}
}
