<?php
include "sesi.php";
include "koneksi.php";

if ($_SESSION['role'] == "pembeli") {
    exit("Akses ditolak");
}


if (isset($_GET['hapus'])) {
    if ($_SESSION['role'] != "administrator" && $_SESSION['role'] != "petugas") {
        exit("Akses ditolak");
    }

    $id = $_GET['hapus'];


    mysqli_query($koneksi, "DELETE FROM produk WHERE id='$id'");

    header("Location: produk.php");
    exit;
}


if (isset($_POST['tambah'])) {
    $nama  = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok  = $_POST['stok'];

    mysqli_query($koneksi, "
        INSERT INTO produk (namaproduk, harga, stok)
        VALUES ('$nama','$harga','$stok')
    ");

    header("Location: produk.php");
    exit;
}


$edit = false;
$edata = [];

if (isset($_GET['edit'])) {
    $edit = true;
    $id = $_GET['edit'];

    $q = mysqli_query($koneksi, "SELECT * FROM produk WHERE id='$id'");
    $edata = mysqli_fetch_assoc($q);
}


if (isset($_POST['update'])) {
    $id    = $_POST['id'];
    $nama  = $_POST['nama'];
    $harga = $_POST['harga'];
    $stok  = $_POST['stok'];

    mysqli_query($koneksi, "
        UPDATE produk SET
            namaproduk='$nama',
            harga='$harga',
            stok='$stok'
        WHERE id='$id'
    ");

    header("Location: produk.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Produk</title>
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
            width: 750px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        h2 { text-align: center; }
        input {
            padding: 6px;
            margin: 4px 0;
            width: 100%;
        }
        button {
            padding: 6px 15px;
            border: none;
            background: #2196F3;
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
        .hapus {
            background: #f44336;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
        }
        .edit {
            background: #4CAF50;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            text-decoration: none;
            font-size: 14px;
        }
        .back { margin-bottom: 15px; }
    </style>
</head>
<body>

<div class="container">
    <h2>Data Produk</h2>

    <div class="back">
        <a href="index.php"><button>Back</button></a>
    </div>


    <form method="post">
        <input type="hidden" name="id" value="<?= $edit ? $edata['id'] : '' ?>">

        <input name="nama"
               placeholder="Nama Produk"
               value="<?= $edit ? $edata['namaproduk'] : '' ?>"
               required>

        <input name="harga"
               type="number"
               placeholder="Harga"
               value="<?= $edit ? $edata['harga'] : '' ?>"
               required>

        <input name="stok"
               type="number"
               placeholder="Stok"
               value="<?= $edit ? $edata['stok'] : '' ?>"
               required>

        <?php if($edit){ ?>
            <button name="update">Update Produk</button>
            <a href="produk.php"><button type="button">Batal</button></a>
        <?php } else { ?>
            <button name="tambah">Tambah Produk</button>
        <?php } ?>
    </form>


    <table>
        <tr>
            <th>Nama</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>

        <?php
        $data = mysqli_query($koneksi, "SELECT * FROM produk");
        while($p = mysqli_fetch_assoc($data)){
        ?>
        <tr>
            <td><?= $p['namaproduk']; ?></td>
            <td><?= $p['harga']; ?></td>
            <td><?= $p['stok']; ?></td>
            <td>
                <a href="?edit=<?= $p['id']; ?>" class="edit">Edit</a>
                <a href="?hapus=<?= $p['id']; ?>"
                   class="hapus"
                   onclick="return confirm('Yakin hapus produk ini?')">
                   Hapus
                </a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>