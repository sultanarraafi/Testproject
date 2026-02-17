<?php
include 'koneksi.php';
include 'fungsi.php';
$no_box = generateNoBox($conn);

if (isset($_POST['simpan'])) {
    $mesin = $_POST['mesin'];
    $no_lot = $_POST['no_lot'];
    $berat_kat = $_POST['berat_kategori'];
    $jml = $_POST['jumlah_cone'];
    $aktual = $_POST['berat_timbang'];
    $op = $_POST['operator'];
    $nobox = $_POST['nomor_box'];

    $sql = "INSERT INTO packing (nomor_box, mesin,no_lot, berat_kategori, jumlah_cone, berat_timbang, operator) 
            VALUES ('$nobox', '$mesin', '$no_lot', '$berat_kat', '$jml', '$aktual', '$op')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Data Berhasil Disimpan!'); window.location='index.php';</script>";
    } else {
        // Ini akan memunculkan popup berisi pesan error dari database
        echo "<script>alert('ERROR BROW: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Gisfil Packing</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f4f4;
            margin: 0;
            padding: 15px;
        }

        .container {
            max-width: 500px;
            background: white;
            margin: auto;
            padding: 20px;
            border-top: 5px solid #1a2a6c;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #1a2a6c;
            text-align: center;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #333;
        }

        select,
        input {
            width: 100%;
            padding: 12px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        .btn-simpan {
            background: #1a2a6c;
            color: white;
            border: none;
            padding: 15px;
            width: 100%;
            border-radius: 5px;
            margin-top: 25px;
            cursor: pointer;
            font-size: 18px;
            font-weight: bold;
        }

        .nav {
            text-align: center;
            margin-bottom: 20px;
        }

        .nav a {
            margin: 0 10px;
            color: #1a2a6c;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="nav">
        <a href="index.php">INPUT</a> | <a href="laporan.php">DATA HARI INI</a>
    </div>

    <div class="container">
        <h2>PACKING NONSTANDAR</h2>
        <form method="POST">
            <label>Nomor Box (Auto)</label>
            <input type="text" name="nomor_box" value="<?= $no_box ?>" readonly style="background: #eee;">

            <label>Pilih Mesin</label>
            <select name="mesin" required>
                <?php
                for ($i = 1; $i <= 21; $i++) {
                    echo "<option value='{$i}A'>Mesin {$i}A</option>";
                    echo "<option value='{$i}B'>Mesin {$i}B</option>";
                }
                ?>
            </select>

            <label>No. Lot</label>
            <input type="text" name="no_lot" placeholder="Masukkan No. Lot" required>

            <label>Kategori Berat</label>
            <select name="berat_kategori">
                <option>1.x kg</option>
                <option>2.x kg</option>
                <option>3.x kg</option>
                <option>4.x kg</option>
                <option>5.x kg</option>
            </select>

            <label>Jumlah Cone</label>
            <input type="number" name="jumlah_cone" placeholder="Contoh: 20" required>

            <label>Berat Aktual (kg)</label>
            <input type="number" step="0.01" name="berat_timbang" placeholder="00.00" required>

            <label>Nama Operator</label>
            <input type="text" name="operator" placeholder="Nama Anda" required>

            <button type="submit" name="simpan" class="btn-simpan">SIMPAN DATA</button>
        </form>
    </div>

</body>

</html>