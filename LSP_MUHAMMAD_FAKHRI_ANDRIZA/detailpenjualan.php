<?php
include "sesi.php";
include "koneksi.php";

if ($_SESSION['role'] == "pembeli") {
    exit("Akses ditolak");
}

if (isset($_GET['hapus_semua'])) {
    if ($_SESSION['role'] == "administrator") {
        mysqli_query($koneksi, "DELETE FROM detailpenjualan");
        header("Location: detailpenjualan.php");
        exit;
    } else {
        exit("Akses ditolak");
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    if ($_SESSION['role'] == "administrator" || $_SESSION['role'] == "petugas") {
        mysqli_query($koneksi, "DELETE FROM detailpenjualan WHERE id='$id'");
        header("Location: detailpenjualan.php");
        exit;
    } else {
        exit("Akses ditolak");
    }
}

$edit = false;
$edata = [];

if (isset($_GET['edit'])) {
    $edit = true;
    $id = $_GET['edit'];

    $q = mysqli_query($koneksi, "
        SELECT dp.id, dp.jumlahproduk, p.namaproduk
        FROM detailpenjualan dp
        JOIN produk p ON dp.produkid = p.id
        WHERE dp.id='$id'
    ");

    $edata = mysqli_fetch_assoc($q);
}

if (isset($_POST['update'])) {
    $id     = $_POST['id'];
    $jumlah = $_POST['jumlah'];

    mysqli_query($koneksi, "
        UPDATE detailpenjualan
        SET jumlahproduk='$jumlah'
        WHERE id='$id'
    ");

    header("Location: detailpenjualan.php");
    exit;
}

$data = mysqli_query($koneksi,"
    SELECT 
        dp.id,
        a.username,
        p.namaproduk,
        dp.jumlahproduk,
        p.harga,
        pj.created_at
    FROM detailpenjualan dp
    JOIN penjualan pj ON dp.penjualanid = pj.id
    JOIN pelanggan pl ON pj.pelangganid = pl.id
    JOIN akun a ON pl.idakun = a.id
    JOIN produk p ON dp.produkid = p.id
    ORDER BY pj.created_at DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detail Penjualan</title>
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
            width: 1050px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        h2 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        table th,
        table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        table th {
            background: #2196F3;
            color: white;
        }

        .btn {
            padding: 6px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            color: white;
        }

        .btn-gray { background: #555; }
        .btn-red  { background: #f44336; }
        .btn-blue { background: #2196F3; }

        .edit {
            background: #4CAF50;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            text-decoration: none;
        }

        .hapus {
            background: #f44336;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            text-decoration: none;
        }

        .top-action {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        @media print {
            body {
                background: white;
            }

            .btn,
            .edit,
            .hapus,
            a,
            form {
                display: none !important;
            }

            .container {
                box-shadow: none;
                width: 100%;
                padding: 0;
            }

            table,
            table th,
            table td {
                border: none !important;
            }

            table th {
                background: #ddd !important;
                color: black !important;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Detail Penjualan</h2>

    <div class="top-action">
        <div>
            <a href="index.php">
                <button class="btn btn-gray">Back</button>
            </a>
            <button onclick="window.print()" class="btn btn-blue">Print</button>
        </div>

        <?php if ($_SESSION['role'] == "administrator") { ?>
            <a href="?hapus_semua=true" onclick="return confirm('Yakin hapus semua data?')">
                <button class="btn btn-red">Hapus Semua</button>
            </a>
        <?php } ?>
    </div>

    <?php if ($edit) { ?>
        <form method="post">
            <input type="hidden" name="id" value="<?= $edata['id']; ?>">
            <input value="<?= $edata['namaproduk']; ?>" readonly>
            <input type="number" name="jumlah" value="<?= $edata['jumlahproduk']; ?>" required>
            <button name="update" class="btn btn-blue">Update</button>
        </form>
    <?php } ?>

    <table>
        <tr>
            <th>Username</th>
            <th>Produk</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Waktu</th>
        </tr>

        <?php while ($dp = mysqli_fetch_assoc($data)) { ?>
        <tr>
            <td><?= $dp['username']; ?></td>
            <td><?= $dp['namaproduk']; ?></td>
            <td><?= $dp['jumlahproduk']; ?></td>
            <td><?= number_format($dp['harga']); ?></td>
            <td><?= date('d-m-Y H:i', strtotime($dp['created_at'])); ?></td>
            <td>
                <a href="?edit=<?= $dp['id']; ?>" class="edit">Edit</a>
                <a href="?hapus=<?= $dp['id']; ?>" class="hapus"
                   onclick="return confirm('Yakin hapus data ini?')">
                   Hapus
                </a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>

</body>
</html>
