<?php
function generateNoBox($conn)
{
    $today = date('Ymd');
    // Mencari nomor box terbesar untuk hari ini
    $query = "SELECT MAX(nomor_box) as maxID FROM packing WHERE nomor_box LIKE 'GSF-$today-%'";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_array($result);

    // PERBAIKAN: Jika data kosong (null), ganti dengan string kosong ""
    $lastNo = $data['maxID'] ?? "";

    // Mengambil 3 angka terakhir
    $lastNoUrut = (int)substr($lastNo, 13, 3);

    $nextNoUrut = $lastNoUrut + 1;

    // Menggabungkan format: GSF-20231027-001
    return "GSF-" . $today . "-" . sprintf('%03s', $nextNoUrut);
}
