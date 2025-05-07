<?php
ini_set('memory_limit', '1024M');
require('fpdf/fpdf.php');

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "jati");
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil tanggal dari GET
$tanggal_awal  = $_GET['tanggal_awal'] ?? '';
$tanggal_akhir = $_GET['tanggal_akhir'] ?? '';

// Validasi input
if (empty($tanggal_awal) || empty($tanggal_akhir)) {
    die("Tanggal awal dan akhir harus diisi.");
}

$sql = "SELECT * FROM penjualan WHERE tanggal BETWEEN '$tanggal_awal' AND '$tanggal_akhir'";
$result = $conn->query($sql);

if (!$result || $result->num_rows === 0) {
    die("Tidak ada data ditemukan.");
}

// Buat PDF
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Laporan', 0, 1, 'C');

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(0, 10, "Periode: $tanggal_awal s/d $tanggal_akhir", 0, 1, 'C');

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 8, 'No', 1);
$pdf->Cell(30, 8, 'Pabrik', 1);
$pdf->Cell(25, 8, 'Jenis Kayu', 1);
$pdf->Cell(25, 8, 'Tanggal', 1);
$pdf->Cell(35, 8, 'Jmlh Produksi M3', 1);
$pdf->Cell(25, 8, 'Harga Per M3', 1);
$pdf->Cell(35, 8, 'Pembeli', 1);
$pdf->Ln();

$pdf->SetFont('Arial', '', 10);
$i = 0;
$max = 500; // maksimum baris untuk hindari infinite loop

while ($row = $result->fetch_assoc()) {
    if (++$i > $max) break;

    $pdf->Cell(10, 8, $row['no'], 1);
    $pdf->Cell(30, 8, $row['nama_pabrik'], 1);
    $pdf->Cell(25, 8, $row['jenis_kayu'], 1);
    $pdf->Cell(25, 8, $row['tanggal'], 1);
    $pdf->Cell(35, 8, $row['jumlah_m3'], 1);
    $pdf->Cell(25, 8, $row['harga_per_m3'], 1);
    $pdf->Cell(35, 8, $row['pembeli'], 1);
    $pdf->Ln();
}

$pdf->Output();
?>
