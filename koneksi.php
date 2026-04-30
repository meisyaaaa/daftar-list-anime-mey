<?php
$host = "localhost";
$user = "root"; // Default phpMyAdmin
$pass = "";     // Default kosong
$db   = "db_web";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>