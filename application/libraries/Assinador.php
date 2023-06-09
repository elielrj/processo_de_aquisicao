<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once('vendor/FPDI/src/autoload.php');

use setasign\Fpdi\Fpdi;

/**
 * Summary of Assinador
 * extraido de https://pt.stackoverflow.com/questions/248585/assinatura-digital-php
 */
class Assinador
{

    private $info;

       public function assinar()
    {
        $pdf = new Fpdi();

        $cert = 'C:\\tcpdf.crt';

        $this->setInfo();

        $pdf->setSignature(
            'file://' . $cert, 
            'file://' . realpath($cert), 
            'senha', '123', 2, $this->info);

        $pdf->AddPage();

    }

    private function assinarPdf($pdfDocument, Certificate $certificado, $senha)
    {
        $pdf = new FPDI();

        $pdf_path = $_SERVER["DOCUMENT_ROOT"] . "\\files\\" . md5(uniqid("")) . ".pdf";
        $path_assinado = $_SERVER["DOCUMENT_ROOT"] . "\\files\\" . md5(uniqid("")) . ".pdf";

        file_put_contents($pdf_path, $pdfDocument);

        $pageCount = $pdf->setSourceFile($pdf_path);
        for ($i = 1; $i <= $pageCount; $i++) {
            $pdf->AddPage();
            $page = $pdf->importPage($i);
            $pdf->useTemplate($page, 0, 0);
        }

        $info = [
            'Name' => $certificado->getCompanyName(),
            'Date' => date("Y.m.d H:i:s"),
            'Reason' => 'Assinatura',
            'ContactInfo' => 'contact',
        ];

        $pdf->setSignature($certificado->__toString(), $certificado->privateKey, $senha, '', 2, $info, "A");
        $pdf->Output($path_assinado, "F");

        return file_get_contents($path_assinado);
    }
}