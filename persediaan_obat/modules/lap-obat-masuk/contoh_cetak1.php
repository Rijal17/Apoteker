<?php
require_once "../../config/database.php";
require_once "../../config/fungsi_tanggal.php";
require_once "../../config/fungsi_rupiah.php";
require_once "../../assets/fpdf/fpdf.php";
$hari_ini = date("d-m-Y");
$tgl1     = $_GET['tgl_awal'];
$explode  = explode('-',$tgl1);
$tgl_awal = $explode[2]."-".$explode[1]."-".$explode[0];

$tgl2      = $_GET['tgl_akhir'];
$explode   = explode('-',$tgl2);
$tgl_akhir = $explode[2]."-".$explode[1]."-".$explode[0];
$pdf = new FPDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFont('Arial', 'B', '16');
$pdf->Cell(0,0,'LAPORAN DATA OBAT MASUK','0',1,'C');
$pdf->SetFont('Arial', '', '12');
$pdf->Cell(0,20,'Laporan Dari Tanggal '.$tgl_awal,'0',1,'C');
$pdf->SetFont('Arial', 'B', '11');

$pdf->SetFont('Arial', '', '11');
$pdf->SetFillColor(70, 130, 180);
$pdf->SetTextColor(255);
$pdf->SetDrawColor(128, 128, 128);
$pdf->Cell(10,7,'No',1,'0', 'C',true);
$pdf->Cell(40,7,'Kode Transaksi',1,'0', 'C',true);
$pdf->Cell(28,7,'Tanggal',1,'0', 'C',true);
$pdf->Cell(25,7,'Kode Obat',1,'0', 'C',true);
$pdf->Cell(27,7,'Nama Obat',1,'0', 'C',true);
$pdf->Cell(30,7,'Jumlah Masuk',1,'0', 'C',true);
$pdf->Cell(25,7,'Satuan',1,'0', 'C',true);
$pdf->Ln();

$pdf->SetFont('Arial', '',11);
$pdf->SetFillColor(224,235,255);
$pdf->SetTextColor(0);
$i=0;
if (isset($_GET['tgl_awal']) && isset($_GET['tgl_akhir'])) {

}
$tampil = mysqli_query($mysqli, "SELECT a.kode_transaksi,a.tanggal_masuk,a.kode_obat,a.jumlah_masuk,b.kode_obat,b.nama_obat,b.satuan
FROM is_obat_masuk as a INNER JOIN is_obat as b ON a.kode_obat=b.kode_obat
WHERE a.tanggal_masuk BETWEEN '$tgl_awal' AND '$tgl_akhir'
ORDER BY a.kode_transaksi ASC");
$count  = mysqli_num_rows($tampil);
if($count == 0) {
    $pdf->SetFont('Arial', 'B', '16');
    $pdf->Cell(185,7,'Data Kosong',1,'0', 'C',true);
    $pdf->SetFont('Arial', 'B', '11');
}else{
    while($data=mysqli_fetch_assoc($tampil)){
        $i++;
        $pdf->Cell(10,7, $i, 1, '0','C', true);
        $pdf->Cell(40,7, $data['kode_transaksi'], 1, '0', 'C',true);
        $pdf->Cell(28,7, $data['tanggal_masuk'], 1, '0', 'L', true);
        $pdf->Cell(25,7, $data['kode_obat'], 1, '0', 'C', true);
        $pdf->Cell(27,7, $data['nama_obat'], 1,'0', 'L', true);
        $pdf->Cell(30,7, $data['jumlah_masuk'], 1,'0', 'C', true);
        $pdf->Cell(25,7, $data['satuan'], 1,'0', 'C', true);
        $pdf->Ln();
    }
}
$pdf->Output('i','Laporan Data Mahasiswa.pdf','false'); 

?>
 <?php echo tgl_eng_to_ind("$hari_ini"); ?>