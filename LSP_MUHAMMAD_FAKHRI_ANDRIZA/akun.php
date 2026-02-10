<?php
include "sesi.php";
include "koneksi.php";


cekRole("administrator");

if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];

    $pelanggan = mysqli_fetch_assoc(
        mysqli_query($koneksi,"SELECT id FROM pelanggan WHERE idakun='$id'")
    );

    if($pelanggan){
        $pelangganid = $pelanggan['id'];

        mysqli_query($koneksi,"DELETE dp 
            FROM detailpenjualan dp
            JOIN penjualan p ON dp.penjualanid = p.id
            WHERE p.pelangganid='$pelangganid'");

        mysqli_query($koneksi,"DELETE FROM penjualan WHERE pelangganid='$pelangganid'");
        mysqli_query($koneksi,"DELETE FROM pelanggan WHERE id='$pelangganid'");
    }

    mysqli_query($koneksi,"DELETE FROM akun WHERE id='$id'");
    header("Location: akun.php");
    exit;
}

$data = mysqli_query($koneksi, "SELECT * FROM akun");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Akun</title>
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
            width: 600px;
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

        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        table th {
            background: #2196F3;
            color: white;
        }

        .aksi a {
            margin: 0 5px;
            text-decoration: none;
            padding: 4px 8px;
            border-radius: 4px;
            color: white;
            font-size: 14px;
        }

        .edit {
            background: #4CAF50;
        }

        .hapus {
            background: #f44336;
        }

        .back {
            margin-top: 15px;
            text-align: center;
        }

        .back button {
            padding: 6px 15px;
            border: none;
            background: #555;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Data Akun</h2>

    <table>
        <tr>
            <th>Username</th>
            <th>Role</th>
            <th>Aksi</th>
        </tr>

        <?php while($a = mysqli_fetch_assoc($data)){ ?>
        <tr>
            <td><?= $a['username']; ?></td>
            <td><?= $a['role']; ?></td>
            <td class="aksi">
                <a href="edit_role.php?id=<?= $a['id']; ?>" class="edit">Edit</a>
                <a href="?hapus=<?= $a['id']; ?>" 
                   class="hapus"
                   onclick="return confirm('Yakin hapus akun ini beserta semua data terkait?')">
                   Hapus
                </a>
            </td>
        </tr>
        <?php } ?>
    </table>

    <div class="back">
        <a href="index.php"><button>Back</button></a>
    </div>
</div>

</body>
</html>
