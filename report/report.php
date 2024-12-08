<?php
session_start();
include "../db.php";
include "../function.php";

if (isset($_POST["login"])) {
    if (empty($_SESSION["user"])) {
        header("Location: user/login.php");
    }
    exit();
}

if (empty($_SESSION["level"])) {
    if ($_SESSION["level"] == 2) {
        header("Location: index.php");
        exit();
    }
}

$data = [];
$chartTitle = "Statistik"; // Judul default untuk chart

if (isset($_POST["mingguan"])) {
    $queryMingguan = "
        SELECT WEEK(waktu_transaksi, 1) AS minggu, COUNT(*) AS total
        FROM pemesanan
        WHERE status_pembayaran = 'sukses' AND YEAR(waktu_transaksi) = YEAR(CURDATE())
        GROUP BY WEEK(waktu_transaksi, 1)";
    $result = mysqli_query($conn, $queryMingguan);

    $data = [
        'Minggu Pertama' => 0,
        'Minggu Kedua' => 0,
        'Minggu Ketiga' => 0,
        'Minggu Keempat' => 0
    ];

    while ($row = mysqli_fetch_assoc($result)) {
        $minggu = $row['minggu'];
        $total = $row['total'];
        if ($minggu >= 1 && $minggu <= 13) {
            $data['Minggu Pertama'] += $total;
        } elseif ($minggu >= 14 && $minggu <= 26) {
            $data['Minggu Kedua'] += $total;
        } elseif ($minggu >= 27 && $minggu <= 39) {
            $data['Minggu Ketiga'] += $total;
        } elseif ($minggu >= 40 && $minggu <= 52) {
            $data['Minggu Keempat'] += $total;
        }
    }
    $chartTitle = "Statistik Mingguan";
} elseif (isset($_POST["bulanan"])) {
    $queryBulanan = "
        SELECT MONTH(waktu_transaksi) AS bulan, COUNT(*) AS total
        FROM pemesanan
        WHERE status_pembayaran = 'sukses' AND YEAR(waktu_transaksi) = YEAR(CURDATE())
        GROUP BY MONTH(waktu_transaksi)";
    $result = mysqli_query($conn, $queryBulanan);

    for ($i = 1; $i <= 12; $i++) {
        $data[$i] = 0;
    }

    while ($row = mysqli_fetch_assoc($result)) {
        $data[$row['bulan']] = $row['total'];
    }
    $chartTitle = "Statistik Bulanan";
} elseif (isset($_POST["tahunan"])) {
    $queryTahunan = "
        SELECT YEAR(waktu_transaksi) AS tahun, COUNT(*) AS total
        FROM pemesanan
        WHERE status_pembayaran = 'sukses'
        GROUP BY YEAR(waktu_transaksi)";
    $result = mysqli_query($conn, $queryTahunan);

    while ($row = mysqli_fetch_assoc($result)) {
        $data[$row['tahun']] = $row['total'];
    }
    $chartTitle = "Statistik Tahunan";
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gili Labak</title>
    <link rel="icon" type="image/png" href="../img/logoGili.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../style/style_report.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-dark fixed-top bg-primary">
        <div class="container">
            <div class="logo">
                <img src="../img/logoGili.png" alt="Gili Labak Logo">
                <a class="navbar-brand" href="index.php">Gili Labak</a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="../about.php">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="../contact.php">Kontak</a></li>
                    <li class="nav-item"><a class="nav-link" href="../report.php">Report</a></li>
                </ul>
                <?php if (empty($_SESSION["user"])) : ?>
                    <a href="user/login.php" class="btn btn-outline-light ms-auto">Login</a>
                <?php else : ?>
                    <ul class="navbar-nav ms-auto user-nav">
                        <li class="nav-item dropdown">
                            <button class="btn btn-dark dropdown-toggle user-dropdown-btn" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="../img/profil.png" alt="User Icon" class="user-icon">
                                <span class="user-greeting">Hello, <?= htmlspecialchars($_SESSION["user"]) ?></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item text-danger logout-link" href="logout.php" onclick="return confirm('Apakah Anda yakin ingin logout?')">
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

    <!-- <div class="container mt-5 pt-5"> -->

        
        <div class="hero-section">
            <div class="section-1">
                <div class="section-1A">
                    <form action="" method="post" class="mb-3">
                    <button type="submit" name="mingguan" class="btn btn-primary">Mingguan</button>
                    <button type="submit" name="bulanan" class="btn btn-primary">Bulanan</button>
                    <button type="submit" name="tahunan" class="btn btn-primary">Tahunan</button>
                </form>
                <hr>
                <div class="table-container">
                    <table border="1" class="data-table">
                        <tr>
                            <th>Rentang</th>
                            <th>Total</th>
                        </tr>
                        <?php if (!empty($data)): ?>
                            <?php foreach ($data as $rentang => $total): ?>
                                <tr>
                                    <td><?= htmlspecialchars($rentang) ?></td>
                                    <td><?= htmlspecialchars($total) ?></td>
                                </tr>
                                <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="2">Tidak ada data</td>
                                    </tr>
                                    <?php endif; ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Section -->
                    <div class="section-2">
                        <!-- Top Section -->
                        <div class="top-right-section">
                            <h3><?= $chartTitle ?></h3>
                            <!-- <h3>Statistik Pengunjung</h3> -->
                            
                            <canvas id="chart" width="400" height="200"></canvas>
                            <!-- <canvas id="chartPengunjung"></canvas> -->
                        </div>
                        <!-- Bottom Section -->
                        <div class="bottom-right-section">
                            <h3>Pengumuman</h3>
                <p>Tidak ada pengumuman baru saat ini. Tetaplah ikuti update terbaru dari kami!</p>
            </div>
        </div>
    <!-- </div> -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const dataLabels = <?= json_encode(array_keys($data)) ?>;
        const dataValues = <?= json_encode(array_values($data)) ?>;

        const ctx = document.getElementById('chart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: dataLabels,
                datasets: [{
                    label: 'Total',
                    data: dataValues,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    }
                }
            }
        });
    </script>
</body>

</html>
