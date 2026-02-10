<?php
include "sesi.php";
include "koneksi.php";


cekRole("administrator");

if(!isset($_GET['id'])){
    header("Location: akun.php");
    exit;
}

$id = $_GET['id'];


$akun = mysqli_fetch_assoc(
    mysqli_query($koneksi, "SELECT * FROM akun WHERE id='$id'")
);

if(!$akun){
    exit("Akun tidak ditemukan!");
}


if(isset($_POST['ubah'])){
    $username = trim($_POST['username']);
    $role     = $_POST['role'];
    $password = $_POST['password'];


    $cek = mysqli_query(
        $koneksi,
        "SELECT * FROM akun WHERE username='$username' AND id!='$id'"
    );

    if(mysqli_num_rows($cek) > 0){
        $error = "Username sudah digunakan oleh akun lain!";
    } else {


        if(!empty($password)){
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            mysqli_query(
                $koneksi,
                "UPDATE akun 
                 SET username='$username', role='$role', password='$password_hash'
                 WHERE id='$id'"
            );
        } else {

            mysqli_query(
                $koneksi,
                "UPDATE akun 
                 SET username='$username', role='$role'
                 WHERE id='$id'"
            );
        }

        header("Location: akun.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Akun</title>
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
        .container {
            background: white;
            padding: 25px;
            width: 360px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        h2 { text-align: center; }
        input, select {
            width: 100%;
            padding: 8px;
            margin-top: 6px;
        }
        button {
            margin-top: 12px;
            padding: 8px;
            width: 100%;
            border: none;
            background: #2196F3;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }
        .back button {
            background: #555;
            margin-top: 8px;
        }
        .error {
            color: red;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Edit Akun</h2>

    <?php if(isset($error)){ ?>
        <p class="error"><?= $error ?></p>
    <?php } ?>

    <form method="post">
        <label>Username</label>
        <input type="text" name="username"
               value="<?= htmlspecialchars($akun['username']); ?>" required>

        <label>Password Baru</label>
        <input type="password" name="password"
               placeholder="Kosongkan jika tidak diubah">

        <label>Role</label>
        <select name="role" required>
            <option value="administrator" <?= $akun['role']=="administrator" ? "selected" : "" ?>>Administrator</option>
            <option value="petugas" <?= $akun['role']=="petugas" ? "selected" : "" ?>>Petugas</option>
            <option value="pembeli" <?= $akun['role']=="pembeli" ? "selected" : "" ?>>Pembeli</option>
        </select>

        <button name="ubah">Simpan Perubahan</button>
    </form>

    <div class="back">
        <a href="akun.php"><button type="button">Back</button></a>
    </div>
</div>

</body>
</html>
