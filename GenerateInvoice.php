<?php
global $DB;
require('fpdf.php');

$pdf = new FPDF();
#billed
$pdf->AddPage();
$pdf->Image('logo.png',20,20,40);
#Stor Fed Tekst
$pdf->SetFont('Arial','B',16);
$pdf->SetXY(20,55);
$pdf->Multicell(0,5,$_GET["Name"]);
$pdf->SetXY(130,20);
$pdf->MultiCell(0,5,"Innowell v/Brian \nMosegaard");
#Lille Fed Tekst
$pdf->SetFont('Arial','B',12);
$pdf->SetXY(100,100);
$pdf->MultiCell(0,5,"Faktura id:\nFaktura Dato:\nTilmeldings Dato:");
$pdf->SetXY(20,126);
$pdf->Write(5,"Kursus                                                                             ANTAL                     PRIS");
$pdf->SetXY(143,145);
$pdf->Write(5,"Total: DKK 1.000");
#Normal tekst
$pdf->SetFont('Arial','',12);
$pdf->SetXY(20,60);
$pdf->Write(5,$_GET["Adress"]);
$pdf->SetXY(130,35);
$pdf->MultiCell(0,5,"Soendergade 33\n9320 Hjallerup\nCVR-nr.: 28918097");
$pdf->SetXY(158,100);
$pdf->MultiCell(0,5, crc32($_GET["Name"].$_GET["Course"].$_GET["Date"] ). "\n".date("d/m/Y")."\n". date("d/m/Y",$_GET["Date"]) );
$pdf->SetXY(20,135);
$pdf->Write(5,$_GET["Course"]);
$pdf->SetXY(127,135);
$pdf->Write(5,"1.stk");
$pdf->SetXY(157,135);
$pdf->Write(5,"DKK 1.000");

$pdf->Line(20,125,180,125);

echo $pdf->Output("I","Faktura.pdf");
?>