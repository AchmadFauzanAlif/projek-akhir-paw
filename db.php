<?php
$host = 'localhost';
$dbname = 'wisata';
$user = 'root';
$pass = '';

$conn  = mysqli_connect("localhost", "root", "", "wisata");

// Periksa koneksi
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Connected successfully";
?>
