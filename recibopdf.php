<?php
require '../vendor/autoload.php';

class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 12);
        //titulo 
        $this->Cell(0, 10, 'Recibos de Pago', 0, 1, 'C');
        $this->Ln(10);
    }
    function Footer()
    {
        $this->setY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Pagina' . $this->PageNo(), 0, 0, 'C');
    }
}



$pdf = new PDF();
$pdf->AddPage('L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(200, 220, 255);
$x1 = 8;
$y1 = 40;
$pdf->SetXY($x1, $y1);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(140, 10, 'Recibo de Pago # 4512', 1, 1, 'C', true);
$pdf->SetFont('Arial', '', 10);
for ($i = 1; $i <= 2; $i++) {
    $pdf->SetX($x1);
    $pdf->Cell(140, 10, "Nombre: Usuario $i", 1, 1, 'L');
    $pdf->SetX($x1);
    $pdf->Cell(140, 10, "Direccion: Direccion $i", 1, 1, 'L');
    $pdf->SetX($x1);
    $pdf->Cell(140, 10, "Monto: $" . number_format(rand(100, 1000), 2), 1, 1, 'L');
    $pdf->SetX($x1);
    $pdf->Cell(140, 10, "Periodo: 01/2025 - 02/2025", 1, 1, 'L');
}
$x2 = 150;
$y2 = 40;
$pdf->SetXY($x2, $y2);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(140, 10, 'Recibo de Pago # 8545', 1, 1, 'C', true);
$pdf->SetFont('Arial', '', 10);
for ($i = 3; $i <= 4; $i++) {
    $pdf->SetX($x2);
    $pdf->Cell(140, 10, "Nombre: Usuario $i", 1, 1, 'L');
    $pdf->SetX($x2);
    $pdf->Cell(140, 10, "Direccion: Direccion $i", 1, 1, 'L');
    $pdf->SetX($x2);
    $pdf->Cell(140, 10, "Monto: $" . number_format(rand(100, 1000), 2), 1, 1, 'L');
    $pdf->SetX($x2);
    $pdf->Cell(140, 10, "Periodo: 01/2025 - 02/2025", 1, 1, 'L');
}
$pdf->Output();
