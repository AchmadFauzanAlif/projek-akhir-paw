<?php
session_start();
$errors = [];

if (isset($_POST["submit"])) {
    include '../db.php';
    if (!preg_match("/^[a-zA-Z .]+$/", $_POST['name'])) {
        $errors['name'] = "Nama hanya boleh berisi huruf";
    }

    if (!preg_match("/^[0-9]+$/", $_POST['nomor'])) {
        $errors['nomor'] = "Nomor telepon hanya boleh berisi angka";
    }

    if (!empty($errors)) {
        echo "<script>alert('" . implode("\\n", $errors) . "');</script>";
    } else {
        $hashed_password = md5($_POST["password"]);

        $username = htmlspecialchars($_POST["username"]);
        $nama = htmlspecialchars($_POST["name"]);
        $alamat = htmlspecialchars($_POST["alamat"]);
        $telp = htmlspecialchars($_POST["nomor"]);

        $query = mysqli_query($conn, "INSERT INTO user (username, password, nama, alamat, hp, level) 
                VALUES ('$username', '$hashed_password', '$nama', '$alamat', '$telp', '$level')");

        if ($query) {
            echo "<script>alert('Data berhasil ditambah!');</script>";
            header('Location: login.php');
            exit();
        } else {
            echo "<script>alert('Gagal menambah data.');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="icon" type="image/png" href="../img/logoGili.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/style_register.css">
    <link rel="stylesheet" href="../style/style.css">
</head>
</head>

<body>
    <div class="register-content">
        <div class="container">
            <div class="card">
                <h2>Daftar Akun</h2>
                <form action="save_register.php" method="POST">
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" required>
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" required>
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" required>
                    <label for="nomor">No. Telp:</label>
                    <input type="text" name="nomor" id="nomor" required>
                    <button type="submit" class="btn btn-primary">Daftar</button>
                    <button name="kembali"  onclick="location.href='login.php'" class="btn btn-secondary">Kembali</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>