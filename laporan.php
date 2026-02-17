<?php include 'koneksi.php'; ?>
<!DOCTYPE html>
<html>

<head>
    <title>Laporan Nonstandar</title>
    <style>
        body {
            font-family: sans-serif;
            padding: 20px;
            background: #f4f4f4;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: center;
        }

        th {
            background: #1a2a6c;
            color: white;
        }

        .header-laporan {
            background: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .total {
            font-size: 24px;
            color: #d32f2f;
            font-weight: bold;
        }

        .btn-cetak {
            background: #2e7d32;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 3px;
            font-size: 12px;
        }

        .btn-edit {
            background: #f39c12;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 3px;
            font-size: 12px;
            margin-right: 5px;
        }

        .btn-hapus {
            background: #e74c3c;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 3px;
            font-size: 12px;
        }
    </style>
</head>

<body>
    <div class="header-laporan">
        <a href="index.php" style="float: right; background: #6c757d; color: white; padding: 8px 15px; text-decoration: none; border-radius: 5px; font-weight: bold; font-size: 14px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">← KEMBALI KE INPUT</a>
        <h2>Laporan Packing Hari Ini</h2>
        <?php
        $tgl = date('Y-m-d');
        $sum = mysqli_query($conn, "SELECT SUM(berat_timbang) as total FROM packing WHERE DATE(tanggal_input) = '$tgl'");
        $res = mysqli_fetch_assoc($sum);
        ?>
        <p>Total Berat Terpacking: <span class="total"><?= number_format($res['total'] ?? 0, 2) ?> kg</span></p>
    </div>

    <div style="background: #e3f2fd; padding: 15px; border-radius: 5px; margin-bottom: 20px; border: 1px solid #90caf9;">
        <form action="export_pdf.php" method="POST" target="_blank">
            <table style="width: 100%; border: none; background: none;">
                <tr>
                    <td style="border: none; text-align: left;">
                        <strong>Laporan Harian:</strong><br>
                        <input type="date" name="tgl_cari" value="<?= date('Y-m-d') ?>" required>
                        <button type="submit" name="tipe" value="harian" style="background: #d32f2f; color: white; border: none; padding: 5px 10px; cursor: pointer;">
                            Download PDF Harian
                        </button>
                    </td>

                    <td style="border: none; text-align: left;">
                        <strong>Laporan Bulanan:</strong><br>
                        <input type="month" name="bln_cari" value="<?= date('Y-m') ?>" required>
                        <button type="submit" name="tipe" value="bulanan" style="background: #1565c0; color: white; border: none; padding: 5px 10px; cursor: pointer;">
                            Download PDF Bulanan
                        </button>
                    </td>
                </tr>
            </table>
        </form>
    </div>

    <table>
        <tr>
            <th>No Box</th>
            <th>Mesin<br>&<br> No Lot</th>
            <th>Berat (kg)</th>
            <th>Cone</th>
            <th>Operator</th>
            <th>Aksi</th>
        </tr>
        <?php
        $data = mysqli_query($conn, "SELECT * FROM packing WHERE DATE(tanggal_input) = '$tgl' ORDER BY LENGTH(mesin) ASC, mesin ASC, no_lot ASC, id DESC");
        while ($row = mysqli_fetch_array($data)) {
        ?>
            <tr>
                <td><?= $row['nomor_box'] ?></td>
                <td>
                    <strong><?= $row['mesin'] ?></strong>
                    <br>
                    <small style="color: #555;">Lot: <?= $row['no_lot'] ?></small>
                </td>
                <td><?= $row['berat_timbang'] ?></td>
                <td><?= $row['jumlah_cone'] ?></td>
                <td><?= $row['operator'] ?></td>
                <td>
                    <a href="edit.php?id=<?= $row['id'] ?>" class="btn-edit">EDIT</a>
                    <a href="hapus.php?id=<?= $row['id'] ?>" class="btn-hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');">HAPUS</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>

</html>