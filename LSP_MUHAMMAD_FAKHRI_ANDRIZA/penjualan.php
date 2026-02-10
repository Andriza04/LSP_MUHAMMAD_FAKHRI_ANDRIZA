<?php
include "sesi.php";
include "koneksi.php";
cekRole("pembeli");


$pelanggan = mysqli_fetch_assoc(
    mysqli_query($koneksi,"SELECT id FROM pelanggan WHERE idakun='".$_SESSION['id']."'")
);
$pelanggan_id = $pelanggan['id'] ?? null;

if(!$pelanggan_id){
    mysqli_query($koneksi,"INSERT INTO pelanggan (idakun) VALUES ('".$_SESSION['id']."')");
    $pelanggan_id = mysqli_insert_id($koneksi);
}


if(isset($_POST['beli'])){
    $produk = $_POST['produk'];
    $jumlah = (int)$_POST['jumlah'];

    $p = mysqli_fetch_assoc(mysqli_query($koneksi,"SELECT * FROM produk WHERE id='$produk'"));

    if(!$p){
        $error = "Produk tidak ditemukan.";
    } elseif($jumlah <= 0){
        $error = "Jumlah harus lebih dari 0.";
    } elseif($jumlah > $p['stok']){
        $error = "Stok tidak cukup!";
    } else {
        $subtotal = $p['harga'] * $jumlah;

        mysqli_query($koneksi,"
            INSERT INTO penjualan (tanggalpenjualan, totalharga, pelangganid)
            VALUES (CURDATE(), '$subtotal', '$pelanggan_id')
        ");
        $penjualan_id = mysqli_insert_id($koneksi);

        mysqli_query($koneksi,"
            INSERT INTO detailpenjualan (penjualanid, produkid, jumlahproduk, subtotal)
            VALUES ('$penjualan_id', '$produk', '$jumlah', '$subtotal')
        ");

        mysqli_query($koneksi,"UPDATE produk SET stok=stok-$jumlah WHERE id='$produk'");
        $success = "Pembelian berhasil!";
    }
}


$produkList = mysqli_query($koneksi,"SELECT * FROM produk WHERE stok>0");


$produkJS = [];
while($pr = mysqli_fetch_assoc($produkList)){
    $produkJS[] = $pr;
}


mysqli_data_seek($produkList, 0);


$riwayat = mysqli_query($koneksi,"
    SELECT pj.tanggalpenjualan,
           dp.jumlahproduk, dp.subtotal, pr.namaproduk
    FROM penjualan pj
    JOIN detailpenjualan dp ON pj.id = dp.penjualanid
    JOIN produk pr ON dp.produkid = pr.id
    WHERE pj.pelangganid = '$pelanggan_id'
    ORDER BY pj.id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pembelian</title>
    <style>
        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: whitesmoke;
            font-family: Arial, sans-serif;
        }

        .container {
            background: white;
            padding: 25px;
            width: 800px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
        }

        form {
            margin-bottom: 15px;
        }

        select, input {
            padding: 6px;
            margin: 6px 0;
            width: 100%;
            box-sizing: border-box;
        }

        button {
            padding: 8px 15px;
            border: none;
            background: #4CAF50;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        table th {
            background: #2196F3;
            color: white;
        }

        .msg-error {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }

        .msg-success {
            color: green;
            text-align: center;
            margin-bottom: 10px;
        }

        .back {
            text-align: center;
            margin-top: 15px;
        }

        .back button {
            background: #555;
        }

        .harga-produk {
            font-weight: bold;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Form Pembelian</h2>

    <?php if(isset($error)){ ?>
        <p class="msg-error"><?= $error ?></p>
    <?php } ?>

    <?php if(isset($success)){ ?>
        <p class="msg-success"><?= $success ?></p>
    <?php } ?>

    <form method="post">
        <label>Produk</label><br>
        <select name="produk" id="produkSelect" required onchange="updateHarga()">
            <?php while($pr = mysqli_fetch_assoc($produkList)): ?>
                <option value="<?= $pr['id'] ?>" data-harga="<?= $pr['harga'] ?>">
                    <?= $pr['namaproduk'] ?> (Stok: <?= $pr['stok'] ?>)
                </option>
            <?php endwhile; ?>
        </select>

        <p class="harga-produk">Harga: Rp <span id="hargaProduk">0</span></p>

        <label>Jumlah</label><br>
        <input type="number" name="jumlah" min="1" value="1" required><br>

        <button name="beli">Beli</button>
    </form>
    <hr>

    <h2>Riwayat Pembelian</h2>
    <table>
        <tr>
            <th>Tanggal</th>
            <th>Produk</th>
            <th>Jumlah</th>
            <th>Subtotal</th>
        </tr>
        <?php while($r = mysqli_fetch_assoc($riwayat)): ?>
        <tr>
            <td><?= $r['tanggalpenjualan'] ?></td>
            <td><?= $r['namaproduk'] ?></td>
            <td><?= $r['jumlahproduk'] ?></td>
            <td><?= $r['subtotal'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>

    <div class="back">
        <a href="index.php"><button type="button">Back</button></a>
    </div>
</div>

<script>
    function updateHarga() {
        const select = document.getElementById('produkSelect');
        const harga = select.options[select.selectedIndex].dataset.harga;
        document.getElementById('hargaProduk').textContent = harga;
    }


    window.onload = updateHarga;
</script>

</body>
</html>
