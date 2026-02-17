<?php
include 'koneksi.php';

// Ambil ID dari URL
$id = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM packing WHERE id = '$id'");
$data = mysqli_fetch_assoc($query);

// Jika tombol update ditekan
if (isset($_POST['update'])) {
    $mesin = $_POST['mesin'];
    $no_lot = $_POST['no_lot'];
    $berat_kat = $_POST['berat_kategori'];
    $jml = $_POST['jumlah_cone'];
    $aktual = $_POST['berat_timbang'];
    $op = $_POST['operator'];

    $sql = "UPDATE packing SET 
            mesin = '$mesin', 
            no_lot = '$no_lot',
            berat_kategori = '$berat_kat', 
            jumlah_cone = '$jml', 
            berat_timbang = '$aktual', 
            operator = '$op' 
            WHERE id = '$id'";

    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Data Berhasil Diperbarui!'); window.location='laporan.php';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Data Packing</title>
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
            border-top: 5px solid #f39c12;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #f39c12;
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

        .btn-update {
            background: #f39c12;
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

        .btn-batal {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #333;
            text-decoration: none;
            background: #e0e0e0;
            padding: 15px;
            border-radius: 5px;
            font-size: 18px;
            font-weight: bold;
            border: 1px solid #ccc;
        }

        .btn-batal:hover {
            background: #d6d6d6;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>EDIT DATA PACKING</h2>
        <form method="POST">
            <label>Nomor Box (Tidak bisa diubah)</label>
            <input type="text" value="<?= $data['nomor_box'] ?>" readonly style="background: #eee;">

            <label>Pilih Mesin</label>
            <select name="mesin" required>
                <option value="<?= $data['mesin'] ?>"><?= $data['mesin'] ?> (Saat ini)</option>
                <?php
                for ($i = 1; $i <= 21; $i++) {
                    echo "<option value='{$i}A'>Mesin {$i}A</option>";
                    echo "<option value='{$i}B'>Mesin {$i}B</option>";
                }
                ?>
            </select>

            <label>No. Lot</label>
            <input type="text" name="no_lot" value="<?= $data['no_lot'] ?>" required>

            <label>Kategori Berat</label>
            <select name="berat_kategori">
                <option value="<?= $data['berat_kategori'] ?>"><?= $data['berat_kategori'] ?> (Saat ini)</option>
                <option value="1.x kg">1.x kg</option>
                <option value="2.x kg">2.x kg</option>
                <option value="3.x kg">3.x kg</option>
                <option value="4.x kg">4.x kg</option>
            </select>

            <label>Jumlah Cone</label>
            <input type="number" name="jumlah_cone" value="<?= $data['jumlah_cone'] ?>" required>

            <label>Berat Aktual (kg)</label>
            <input type="number" step="0.01" name="berat_timbang" value="<?= $data['berat_timbang'] ?>" required>

            <label>Nama Operator</label>
            <input type="text" name="operator" value="<?= $data['operator'] ?>" required>

            <button type="submit" name="update" class="btn-update">UPDATE DATA</button>
            <a href="laporan.php" class="btn-batal">Batal & Kembali</a>
        </form>
    </div>

</body>

</html>