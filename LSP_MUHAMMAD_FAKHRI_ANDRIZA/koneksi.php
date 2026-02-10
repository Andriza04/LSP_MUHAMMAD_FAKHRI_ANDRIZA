<?php
$koneksi = mysqli_connect("localhost", "root", "", "crud");

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
