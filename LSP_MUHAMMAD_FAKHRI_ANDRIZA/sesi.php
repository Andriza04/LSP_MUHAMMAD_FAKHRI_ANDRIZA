<?php
session_start();


if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}


if (!isset($_SESSION['username']) || !isset($_SESSION['role'])) {
    header("Location: login.php");
    exit;
}


function cekRole($role) {
    if ($_SESSION['role'] != $role) {
        exit("Akses ditolak");
    }
}
?>
