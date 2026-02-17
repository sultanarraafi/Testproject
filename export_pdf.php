<?php
// Panggil library FPDF
require('fpdf/fpdf.php');
include 'koneksi.php';

// Cek tombol mana yang ditekan
if (isset($_POST['tipe'])) {
    $tipe = $_POST['tipe'];

    if ($tipe == 'harian') {
        $tgl = $_POST['tgl_cari'];
        $judul = "LAPORAN HARIAN: " . date('d-m-Y', strtotime($tgl));
        $query = "SELECT * FROM packing WHERE DATE(tanggal_input) = '$tgl' ORDER BY LENGTH(mesin) ASC, mesin ASC, no_lot ASC";
        $nama_file = "Laporan_Harian_" . $tgl . ".pdf";
    } else {
        $bln = $_POST['bln_cari']; // Format YYYY-MM
        $judul = "LAPORAN BULANAN: " . date('F Y', strtotime($bln));
        $query = "SELECT * FROM packing WHERE DATE_FORMAT(tanggal_input, '%Y-%m') = '$bln' ORDER BY DATE(tanggal_input) ASC, LENGTH(mesin) ASC, mesin ASC";
        $nama_file = "Laporan_Bulanan_" . $bln . ".pdf";
    }
} else {
    die("Akses dilarang");
}

// Inisialisasi PDF (Potrait, ukuran mm, kertas A4)
$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();

// --- HEADER ---
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'GISFIL TEXTILE', 0, 1, 'C');
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'DATA PACKING NONSTANDAR', 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, $judul, 0, 1, 'C');
$pdf->Ln(5); // Spasi ke bawah

// --- TABEL HEADER ---
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(200, 220, 255); // Warna biru muda

// Lebar kolom (Total 190mm)
$w = array(10, 45, 20, 30, 25, 20, 40);
// No, No Box, Mesin, Lot, Berat, Cone, Operator

$pdf->Cell($w[0], 10, 'No', 1, 0, 'C', true);
$pdf->Cell($w[1], 10, 'No Box', 1, 0, 'C', true);
$pdf->Cell($w[2], 10, 'Mesin', 1, 0, 'C', true);
$pdf->Cell($w[3], 10, 'No Lot', 1, 0, 'C', true);
$pdf->Cell($w[4], 10, 'Berat(Kg)', 1, 0, 'C', true);
$pdf->Cell($w[5], 10, 'Cone', 1, 0, 'C', true);
$pdf->Cell($w[6], 10, 'Operator', 1, 1, 'C', true); // 1 di parameter akhir artinya ganti baris

// --- ISI DATA ---
$pdf->SetFont('Arial', '', 10);
$data = mysqli_query($conn, $query);
$no = 1;
$total_berat = 0;
$total_cone = 0;

while ($row = mysqli_fetch_array($data)) {
    $pdf->Cell($w[0], 8, $no++, 1, 0, 'C');
    $pdf->Cell($w[1], 8, $row['nomor_box'], 1, 0, 'C');
    $pdf->Cell($w[2], 8, $row['mesin'], 1, 0, 'C');
    $pdf->Cell($w[3], 8, $row['no_lot'], 1, 0, 'C');
    $pdf->Cell($w[4], 8, $row['berat_timbang'], 1, 0, 'C');
    $pdf->Cell($w[5], 8, $row['jumlah_cone'], 1, 0, 'C');
    $pdf->Cell($w[6], 8, $row['operator'], 1, 1, 'L');

    $total_berat += $row['berat_timbang'];
    $total_cone += $row['jumlah_cone'];
}

// --- TOTAL ---
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell($w[0] + $w[1] + $w[2] + $w[3], 10, 'TOTAL', 1, 0, 'C', true);
$pdf->Cell($w[4], 10, number_format($total_berat, 2), 1, 0, 'C', true);
$pdf->Cell($w[5], 10, $total_cone, 1, 0, 'C', true);
$pdf->Cell($w[6], 10, '', 1, 1, 'C', true);

// --- FOOTER TANGGAL CETAK ---
$pdf->Ln(10);
$pdf->SetFont('Arial', 'I', 9);
$pdf->Cell(0, 10, 'Dicetak pada: ' . date('d-m-Y H:i:s'), 0, 1, 'R');

// Output PDF ke browser
$pdf->Output('I', $nama_file);
