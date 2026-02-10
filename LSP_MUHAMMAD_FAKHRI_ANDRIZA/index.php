<?php include "sesi.php"; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: whitesmoke;
            font-family: Arial, sans-serif;
        }

        .dashboard {
            background: white;
            padding: 30px;
            width: 350px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            text-align: center;
        }

        .dashboard ul {
            list-style: none;
            padding: 0;
        }

        .dashboard ul li {
            margin: 10px 0;
        }

        .dashboard ul li a {
            display: block;
            padding: 8px;
            background: #2196F3;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }

        .dashboard ul li a:hover {
            background: #1976D2;
        }

        .logout {
            display: inline-block;
            margin-top: 15px;
            color: red;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="dashboard">
    <h2>Halo, <?= $_SESSION['username']; ?> 👋</h2>
    <p>Role: <b><?= $_SESSION['role']; ?></b></p>
    <hr>

    <?php if($_SESSION['role']=="administrator"){ ?>
        <ul>
            <li><a href="akun.php">Kelola Akun</a></li>
            <li><a href="produk.php">Data Produk</a></li>
            <li><a href="detailpenjualan.php">Detail Penjualan</a></li>
        </ul>
    <?php } ?>

    <?php if($_SESSION['role']=="petugas"){ ?>
        <ul>
            <li><a href="produk.php">Data Produk</a></li>
            <li><a href="detailpenjualan.php">Detail Penjualan</a></li>
        </ul>
    <?php } ?>

    <?php if($_SESSION['role']=="pembeli"){ ?>
        <ul>
            <li><a href="penjualan.php">Pembelian</a></li>
        </ul>
    <?php } ?>

    <hr>
    <a href="logout.php" class="logout">Logout</a>
</div>

</body>
</html>
