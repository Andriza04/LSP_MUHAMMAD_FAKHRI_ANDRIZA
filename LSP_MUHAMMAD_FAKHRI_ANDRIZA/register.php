<?php
include "koneksi.php";


if(isset($_POST['register'])){
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $role = "pembeli";

    $cek = mysqli_query($koneksi, "SELECT * FROM akun WHERE username='$username'");
    if(mysqli_num_rows($cek) > 0){
        $error = "Username sudah digunakan! <br> Silahkan pilih username lain.";
    } else {
        mysqli_query($koneksi, "INSERT INTO akun (username,password,role) VALUES ('$username','$password','$role')");
        $akun_id = mysqli_insert_id($koneksi);
        mysqli_query($koneksi, "INSERT INTO pelanggan (idakun) VALUES ('$akun_id')");

        echo "<script>alert('Registrasi berhasil! Silahkan login.'); window.location='login.php';</script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
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

        .register-box {
            background: white;
            padding: 25px;
            width: 320px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .register-box h2 {
            text-align: center;
        }

        .register-box input {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
        }

        .register-box button {
            width: 100%;
            padding: 8px;
            background: #2196F3;
            border: none;
            color: white;
            border-radius: 4px;
            cursor: pointer;
        }

        .register-box p {
            text-align: center;
            margin-top: 10px;
        }

        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="register-box">
    <h2>Register Pengguna Baru</h2>

    <?php if(isset($error)) { ?>
        <p class="error"><?= $error ?></p>
    <?php } ?>

    <form method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button name="register">Register</button>
    </form>

    <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
</div>

</body>
</html>
