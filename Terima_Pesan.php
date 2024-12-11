<?php
session_start();

if (isset($_POST["login"])) {
    if (empty($_SESSION["user"])) {
        header("Location: user/login.php");
    }
    exit();
}

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
                <?php if (empty($_SESSION["user"])) : ?>
                    <ul class="navbar-nav position-absolute top-50 start-50 translate-middle ">
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.php">Tentang</a></li>
                        <li class="nav-item"><a class="nav-link" href="tiket/tiket.php">Tiket</a></li>
                        <li class="nav-item"><a class="nav-link" href="contact.php">Kontak</a></li>
                    </ul>
                <?php elseif (!empty($_SESSION["user"])) : ?>
                    <ul class="navbar-nav position-absolute top-50 start-50 translate-middle ">
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="tiket/tiket.php">Tiket</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.php">Tentang</a></li>
                        <li class="nav-item"><a class="nav-link" href="contact.php">Kontak</a></li>
                        <li class="nav-item"><a class="nav-link" href="Terima_Pesan.php">Pesan</a></li>
                        <?php if (!isset($_SESSION["level"]) == "1") : ?>
                            <li class="nav-item"><a class="nav-link" href="report.php">Report</a></li>
                        <?php endif; ?>
                    </ul>
                <?php endif; ?>
                <?php if (empty($_SESSION["user"])) : ?>
                    <a href="user/login.php" class="btn btn-outline-light ms-auto">Login</a>

                <?php elseif (!empty($_SESSION["user"])) : ?>
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
                                <span class="user-greeting">Hello, <?= htmlspecialchars($_SESSION["user"]) ?></span>
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
                <?php endif; ?>
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
                        <tr>
                            <td>13/12/2024</td>
                            <td>Dicky Prasetyo</td>
                            <td>0895564352</td>
                            <td>Dicky123@gmail.com</td>
                            <td>Saran</td>
                            <td>saran pengelolan parkirnya diperbanyaak agar dapat menampung banyak kendaraan tanpa harus menunggu</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

</body>

</html>