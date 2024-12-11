<?php 
include "../function.php";
include "../db.php";

if (empty($_SESSION["user"])) {
    header("Location: ../user/login.php");
    exit();
}


$level = $_SESSION["level"];
if($level == 2 && $level == 1) {
    header("Location: ../index.php");
    exit;
}


if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = mysqli_query($conn, "DELETE FROM detail_tiket WHERE id = $id");
    header("location: cek_pembayaran.php");
    exit;
}

$conn->close();

?>