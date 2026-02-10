<?php
include "koneksi.php";
session_start();

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $query = mysqli_query($koneksi, "SELECT * FROM akun WHERE username='$username'");
    $data  = mysqli_fetch_assoc($query);

    if ($data && password_verify($password, $data['password'])) {
        $_SESSION['login'] = true;
        $_SESSION['id'] = $data['id'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['role'] = $data['role'];

        header("Location: index.php");
        exit;
    } else {
        $error = "Login gagal! <br> Username atau password salah.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
            background: #f2f2f2;
        }

        .login-box {
            background: white;
            padding: 25px;
            border-radius: 8px;
            width: 300px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .login-box h2 {
            text-align: center;
        }

        .login-box input {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
        }

        .login-box button {
            width: 100%;
            padding: 8px;
            background: #2196F3;
            border: none;
            color: white;
            cursor: pointer;
            border-radius: 4px;
        }

        .login-box p {
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

<div class="login-box">
    <h2>Login</h2>

    <?php if (isset($error)) { ?>
        <p class="error"><?= $error; ?></p>
    <?php } ?>

    <form method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" name="login">Login</button>
    </form>

    <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
</div>

</body>
</html>
