<?php
// Set zona waktu ke Jakarta (WIB)
date_default_timezone_set('Asia/Jakarta');

$conn = mysqli_connect("localhost", "root", "", "db_packing_gisfil");
if (!$conn) {
    die("Koneksi Gagal: " . mysqli_connect_error());
}
