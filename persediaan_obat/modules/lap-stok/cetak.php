<?php
require_once "../../config/database.php";
require_once "../../assets/fpdf/fpdf.php";

$pdf = new FPDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', '16');
$pdf->Cell(0,20,'Laporan Stok Obat','0',1,'C');
$pdf->SetFont('Arial', 'B', '11');

$pdf->SetFont('Arial', '', '11');
$pdf->SetFillColor(70, 130, 180);
$pdf->SetTextColor(255);
$pdf->SetDrawColor(128, 128, 128);
$pdf->Cell(18,7,'No',1,'0', 'C',true);
$pdf->Cell(25,7,'Kode Obat',1,'0', 'C',true);
$pdf->Cell(48,7,'Nama Obat',1,'0', 'C',true);
$pdf->Cell(25,7,'Harga Beli',1,'0', 'C',true);
$pdf->Cell(25,7,'Harga Jual',1,'0', 'C',true);
$pdf->Cell(20,7,'Stok',1,'0', 'C',true);
$pdf->Cell(25,7,'Satuan',1,'0', 'C',true);
$pdf->Ln();

$pdf->SetFont('Arial', '',11);
$pdf->SetFillColor(224,235,255);
$pdf->SetTextColor(0);
$i=0;
$tampil = mysqli_query($mysqli, "SELECT * FROM is_obat ORDER BY nama_obat ASC");
$count  = mysqli_num_rows($tampil);
if($count == 0) {
    $pdf->SetFont('Arial', 'B', '16');
    $pdf->Cell(186,7,'Data Kosong',1,'0', 'C',true);
    $pdf->SetFont('Arial', 'B', '11');
}
while($data=mysqli_fetch_array($tampil)){
    $i++;
    $pdf->Cell(18,7, $i, 1, '0','C', true);
    $pdf->Cell(25,7, $data['kode_obat'], 1, '0', 'C',true);
    $pdf->Cell(48,7, $data['nama_obat'], 1, '0', 'L', true);
    $pdf->Cell(25,7, $data['harga_beli'], 1, '0', 'C', true);
    $pdf->Cell(25,7, $data['harga_jual'], 1,'0', 'C', true);
    $pdf->Cell(20,7, $data['stok'], 1,'0', 'C', true);
    $pdf->Cell(25,7, $data['satuan'], 1,'0', 'C', true);
    $pdf->Ln();
}
$pdf->Output('i','Laporan Data Stok Apoteker.pdf','false'); 
?>