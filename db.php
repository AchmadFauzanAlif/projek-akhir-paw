<?php
// Database connection
$host = 'localhost';
$dbname = 'gililabak';
$user = 'root';
$pass = '';

try {
    $conn = new PDO($host,$dbname, $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
