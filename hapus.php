<?php
include 'koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Proses hapus data
    $hapus = mysqli_query($conn, "DELETE FROM packing WHERE id = '$id'");

    if ($hapus) {
        echo "<script>alert('Data berhasil dihapus!'); window.location='laporan.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data!'); window.location='laporan.php';</script>";
    }
} else {
    header("Location: laporan.php");
}
