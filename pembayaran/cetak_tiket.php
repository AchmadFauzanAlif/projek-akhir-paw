<?php 
session_start();

# Penambahan agar user tidak bisa masuk
if (empty($_SESSION["user"])) {
    header("Location: ../user/login.php");
    exit();
}

# filter user
if($_SESSION['level'] == '1') {
    header("Location: ../index.php");
    exit();
}

if(empty($_GET["id"])) {
    $id = $_GET["id"];

    echo $id;
    die;
}


?>

