<?php
session_start();

if (isset($_POST["login"])) {
    if (empty($_SESSION["user"])) {
        header("Location: user/login.php");
    }
    exit();
}


if(empty($_SESSION["level"])){
    if($_SESSION["level"] == 2) {
        header("Location: index.php");
        exit();
    }
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
    <link href="style/style_report.css" rel="stylesheet">
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
                <a class="section-a" href="./report/report_harian.php">Harian</a>
                <a class="section-a" href="./report/report_bulanan.php">Bulanan</a>
                <a class="section-a" href="./report/report_tahunan.php">Tahunan</a>
                <a class="section-a" href="./report/report_keuangan.php">Laporan Keuangan</a>
                <hr>
                <div class="table-container">
                    <table class="data-table">
                        <tr>
                            <th>Hari/Tanggal</th>
                            <th>Total Pengunjung</th>
                        </tr>
                        <tr>
                            <td>Senin</td>
                            <td>50</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Right Section -->
        <div class="section-2">
            <!-- Top Section -->
            <div class="top-right-section">
                <h3>Statistik Pengunjung</h3>

                <canvas id="chartPengunjung"></canvas>
            </div>
            <!-- Bottom Section -->
            <div class="bottom-right-section">
                <h3>Pengumuman</h3>
                <p>Tidak ada pengumuman baru saat ini. Tetaplah ikuti update terbaru dari kami!</p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Chart 1: Visitor Statistics
        const ctx1 = document.getElementById('chartPengunjung').getContext('2d');
        new Chart(ctx1, {
            type: 'doughnut',
            data: {
                labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                datasets: [{
                    data: [10, 15, 20, 25, 30, 35, 40],
                    backgroundColor: ['#4caf50', '#2196f3', '#ffeb3b', '#f44336', '#9c27b0', '#ff9800', '#00bcd4'],
                }]
            }
        });

        // Chart 2: Weekly Visitors
        const ctx2 = document.getElementById('weekChart').getContext('2d');
        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                datasets: [{
                    label: 'Pengunjung',
                    data: [10, 15, 20, 25, 30, 35, 40],
                    backgroundColor: '#1e90ff'
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

</body>

</html>