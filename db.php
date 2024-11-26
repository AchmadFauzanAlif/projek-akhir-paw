<?php
// Database connection
// $host = 'localhost';
// $dbname = 'wisata';
// $user = 'root';
// $pass = '';



// try {
//     $conn = new PDO($host,$dbname, $user, $pass);
//     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch (PDOException $e) {
//     die("Connection failed: " . $e->getMessage());
// }

?>

<?php
// Database connection
$host = 'localhost';
$dbname = 'wisata';
$user = 'root';
$pass = '';

// Buat koneksi ke database
// $conn = mysqli_connect($host, $user, $pass, $dbname);

$conn  = mysqli_connect("localhost", "root", "", "wisata");

// Periksa koneksi
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Connected successfully";
?>
