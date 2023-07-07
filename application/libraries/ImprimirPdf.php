<?php

require_once('vendor/PDFMerger/PDFMerger.php');

use PDFMerger\PDFMerger;

use setasign\Fpdi\Fpdi;
use setasign\Fpdi\PdfParser;


require_once('vendor/autoload.php');
class ImprimirPdf
{
	private $listaDePath;
	private $nomeDoArquivo;

	public function __construct()
	{
		include_once 'vendor/PDFMerger/PDFMerger.php';

		$this->listaDePath = [];
	}

	public function processo($processo)
	{
		$this->nomeDoArquivo = $processo->toString();

		foreach ($processo->tipo->listaDeArtefatos as $artefato) {
			if ($artefato->arquivos != null) {

				foreach ($artefato->arquivos as $arquivo) {

					if ($arquivo->path != '' && $arquivo->path != null) {

						$this->imprimirEmPdf($arquivo->path);

					}
				}
			}
		}
		$this->unirListaDePdf();
	}

	private function imprimirEmPdf($path)
	{
		$pdf = new PDFMerger;

		$pdf->addPDF($path, 'all');


		$novo_path = 'arquivos/tmp/' . uniqid() . '.pdf';

		$pdf->merge('file', $novo_path);
/*


		$this->listaDePath[] = $path;


		$novo_path = 'arquivos/tmp/' . uniqid() . '.pdf';

		$pdf2 = new Fpdi();

		//$pdf2->sig
		$pdf2->AddPage();
		$pdf2->Output($novo_path,'D');

		$novo_path = 'arquivos/tmp/' . uniqid() . '.pdf';


		$pdf = new Fpdi();

		$pdf->AddPage();
		$pdf->setSourceFile($path);
		$pdf->Output($novo_path,'F');

		$this->listaDePath[] = $novo_path;
		*/
	}

	private function unirListaDePdf()
	{
		$pdf = new PDFMerger;

		foreach ($this->listaDePath as $path) {

			$pdf->addPDF($path, 'all');
		}

		$pdf->merge('browser');

		foreach ($this->listaDePath as $path) {
			unilink($path);
		}
	}
}
