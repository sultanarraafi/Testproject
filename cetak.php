<?php
include 'koneksi.php';
$id = $_GET['id'];
$data = mysqli_query($conn, "SELECT * FROM packing WHERE id = '$id'");
$d = mysqli_fetch_array($data);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Cetak Label - <?= $d['nomor_box'] ?></title>
    <style>
        @page {
            size: 80mm 80mm;
            margin: 0;
        }

        body {
            font-family: 'Courier New', Courier, monospace;
            width: 70mm;
            padding: 5mm;
        }

        .box {
            border: 2px solid black;
            padding: 10px;
            text-align: center;
        }

        .barcode {
            font-size: 20px;
            font-weight: bold;
            margin: 10px 0;
            border-bottom: 1px dashed black;
            padding-bottom: 5px;
        }

        .info {
            text-align: left;
            font-size: 14px;
        }
    </style>
</head>

<body onload="window.print()">
    <div class="box">
        <div style="font-size: 18px; font-weight: bold;">GISFIL TEXTILE</div>
        <div class="barcode"><?= $d['nomor_box'] ?></div>
        <div class="info">
            #MC : <?= $d['mesin'] ?><br>
            Berat: <?= $d['berat_timbang'] ?> kg<br>
            Isi : <?= $d['jumlah_cone'] ?> Cone<br>
            Tgl : <?= date('d/m/Y H:i', strtotime($d['tanggal_input'])) ?><br>
            Opt : <?= $d['operator'] ?>
        </div>
    </div>
</body>

</html>