<?php
session_start();
include "db.php";
include "function.php";

if (isset($_POST["login"])) {
    if (empty($_SESSION["user"])) {
        header("Location: user/login.php");
    }
    exit();
}

if (!empty($_SESSION["level"])) {
    if ($_SESSION["level"] == 2) {
        header("Location: index.php");
        exit();
    }
}

$kontak = query("SELECT * FROM kontak");
$i = 1;


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gili Labak</title>
    <link rel="icon" type="image/png" href="img/logoGili.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="style/style_terima_pesan.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-dark fixed-top bg-primary">
        <div class="container">
            <div class="logo">
                <img src="img/logoGili.png" alt="Gili Labak Logo">
                <a class="navbar-brand" href="index.php">Gili Labak</a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav position-absolute top-50 start-50 translate-middle ">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="Terima_Pesan.php">Pesan</a></li>
                    <li class="nav-item"><a class="nav-link" href="report/report.php">Report</a></li>
                </ul>

                <ul class="navbar-nav ms-auto user-nav">
                        <li class="nav-item dropdown">
                            <button
                                class="btn btn-dark dropdown-toggle user-dropdown-btn"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">
                                <img
                                    src="img/profil.png"
                                    alt="User Icon"
                                    class="user-icon">
                                <span class="user-greeting">Halo, <?= htmlspecialchars($_SESSION["user"]) ?></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a
                                        class="dropdown-item text-danger logout-link"
                                        href="logout.php"
                                        onclick="return confirm('Apakah Anda yakin ingin logout?')">
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>

            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="section-1">
            <div class="section-1A">
                <a class="section-a" href="">Bulanan</a>
                <a class="section-a" href="">Tahunan</a>
                <hr>
                <div class="table-container">
                    <table class="data-table">
                        <tr>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>No.Telphone</th>
                            <th>Email</th>
                            <th>Kategori Pertanyaan</th>
                            <th>Isi Pesan</th>
                        </tr>
                    <?php foreach($kontak as $rows) : ?>
                        <tr>
                            <td><?= $rows["tanggal"] ?></td>
                            <td><?= $rows["nama"] ?></td>
                            <td><?= $rows["telp"] ?></td>
                            <td><?= $rows["kategori"] ?></td>
                            <td><?= $rows["email"] ?></td>
                            <td><?= $rows["pesan"] ?></td>
                        </tr>
                    <?php $i++; endforeach; ?>
                    </table>
                </div>
            </div>
        </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>