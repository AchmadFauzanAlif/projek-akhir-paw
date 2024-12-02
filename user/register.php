<?php
session_start();
include "../db.php";
include "../function.php";
$errors = [];

if (isset($_POST["daftar"])) {
    if (!preg_match("/^[a-zA-Z .]+$/", $_POST['nama'])) {
        $errors['name'] = "Nama hanya boleh berisi huruf";
    }

    if (!preg_match("/^[0-9]+$/", $_POST['nomor'])) {
        $errors['nomor'] = "Nomor telepon hanya boleh berisi angka";
    }

    if (!empty($errors)) {
        echo "<script>alert('" . implode("\\n", $errors) . "');</script>";
    } else {

        $username = htmlspecialchars($_POST["username"]);
        $hashed_password = md5($_POST["password"]);
        $nama = htmlspecialchars($_POST["nama"]);
        $alamat = htmlspecialchars($_POST["alamat"]);
        $telp = htmlspecialchars($_POST["nomor"]);
        $jenisKelamin = $_POST["jenis-kelamin"];

        $tambahUser = "INSERT INTO users VALUES (NULL, '$username', '$hashed_password', 2)";

        if (mysqli_query($conn, $tambahUser)) {
            $userId = mysqli_insert_id($conn);

            # tabel pelanggan
            $tambahPelanggan = "INSERT INTO pelanggan VALUES (NULL, '$userId', '$nama', '$jenisKelamin', '$telp', '$alamat')";

            if(mysqli_query($conn, $tambahPelanggan)) {
                echo "<script>alert('Data Berhasil ditambahkan');</script>";
                header("../index.php");
                die;
            } else {
                echo "error menambahkan data user: ". mysqli_error($conn);
                die;
            }
        } else {
            echo "error menambahkan user: ". mysqli_error($conn);
            die;
        }
        
        
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

<body>
    <div class="register-content d-flex justify-content-center align-items-center vh-100">
        <div class="container">
            <div class="card shadow p-4">
                <h2 class="text-center mb-4">Daftar Akun</h2>
                <form action="" method="POST">
                    <!-- Username -->
                    <div class="mb-3">
                        <label for="username" class="form-label">Username:</label>
                        <input type="text" class="form-control" name="username" id="username" placeholder="Masukkan username" required>
                    </div>
                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Masukkan password" required>
                    </div>
                    <!-- Nama -->
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama:</label>
                        <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan nama lengkap" required>
                    </div>
                    <!-- No. Telp -->
                    <div class="mb-3">
                        <label for="nomor" class="form-label">No. Telp:</label>
                        <input type="tel" class="form-control" name="nomor" id="nomor" placeholder="Masukkan nomor telepon" required>
                    </div>
                    <!-- Jenis Kelamin -->
                    <fieldset class="mb-3">
                        <legend>Jenis Kelamin</legend>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis-kelamin" id="pria" value="L" required>
                            <label class="form-check-label" for="pria">Pria</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="jenis-kelamin" id="wanita" value="P">
                            <label class="form-check-label" for="wanita">Wanita</label>
                        </div>
                    </fieldset>
                    <!-- Alamat -->
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat:</label>
                        <textarea class="form-control" name="alamat" id="alamat" rows="3" placeholder="Masukkan alamat" required></textarea>
                    </div>
                    <!-- Tombol -->
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary" name="daftar">Daftar</button>
                        <button type="button" onclick="location.href='login.php'" class="btn btn-secondary">Kembali</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
