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

if(empty($_SESSION["level"])){
    if($_SESSION["level"] == 2) {
        header("Location: index.php");
        exit();
    }
} 

$data = [];

if (isset($_POST["harian"])) {
    // Data Harian
    $queryHarian = "
        SELECT DATE(waktu_transaksi) AS tanggal, COUNT(*) AS total
        FROM pemesanan
        WHERE status_pembayaran = 'sukses'
        GROUP BY DATE(waktu_transaksi)";
        
    $result = mysqli_query($conn, $queryHarian);

    while ($row = mysqli_fetch_assoc($result)) {
        $data[$row['tanggal']] = $row['total'];
    }


} elseif (isset($_POST["mingguan"])) {
    // Data Mingguan (dibagi menjadi 4 grup)
    $queryMingguan = "
        SELECT WEEK(waktu_transaksi, 1) AS minggu, COUNT(*) AS total
        FROM pemesanan
        WHERE status_pembayaran = 'sukses' AND YEAR(waktu_transaksi) = YEAR(CURDATE())
        GROUP BY WEEK(waktu_transaksi, 1)";
    $result = mysqli_query($conn, $queryMingguan);

    // Inisialisasi array untuk menyimpan data dalam 4 grup
    $data = [
        'Minggu Pertama' => 0,
        'Minggu Kedua' => 0,
        'Minggu Ketiga' => 0,
        'Minggu Keempat' => 0
    ];

    // Proses data mingguan ke dalam 4 grup
    while ($row = mysqli_fetch_assoc($result)) {
        $minggu = $row['minggu'];
        $total = $row['total'];

        // Tentukan grup berdasarkan nomor minggu
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

    foreach($data as $dataNo => $dataJumlah ) {
        $no = $dataNo;
        $jumlah = $dataJumlah;
    }
} elseif (isset($_POST["bulanan"])) {
    // Data Bulanan
    $queryBulanan = "
        SELECT MONTH(waktu_transaksi) AS bulan, COUNT(*) AS total
        FROM pemesanan
        WHERE status_pembayaran = 'sukses' AND YEAR(waktu_transaksi) = YEAR(CURDATE())
        GROUP BY MONTH(waktu_transaksi)";
    $result = mysqli_query($conn, $queryBulanan);
    // $result = query($queryBulanan)[0];

    
    // Inisialisasi bulan 1-12 dengan 0
    for ($i = 1; $i <= 12; $i++) {
        $data[$i] = 0;
    }
    
    while ($row = mysqli_fetch_assoc($result)) {
        $data[$row['bulan']] = $row['total'];
    }
    
    foreach($data as $dataNo => $dataJumlah ) {
        $no = $dataNo;
        $jumlah = $dataJumlah;
    }

} elseif (isset($_POST["tahunan"])) {
    // Data Tahunan
    $queryTahunan = "
        SELECT YEAR(waktu_transaksi) AS tahun, COUNT(*) AS total
        FROM pemesanan
        WHERE status_pembayaran = 'sukses'
        GROUP BY YEAR(waktu_transaksi)";
    $result = mysqli_query($conn, $queryTahunan);

    while ($row = mysqli_fetch_assoc($result)) {
        $data[$row['tahun']] = $row['total'];
    }

    foreach($data as $dataNo => $dataJumlah ) {
        $no = $dataNo;
        $jumlah = $dataJumlah;
    }
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
                    <ul class="navbar-nav position-absolute top-50 start-50 translate-middle ">
                        <li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="../about.php">Tentang</a></li>
                        <li class="nav-item"><a class="nav-link" href="../contact.php">Kontak</a></li>
                        <li class="nav-item"><a class="nav-link" href="../report.php">Report</a></li>
                    </ul>

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
                                    src="../img/profil.png"
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

            <form action="" method="post">
                <button type="submit" name="harian">Harian</button>
                <button type="submit" name="mingguan">Mingguan</button>
                <button type="submit" name="bulanan">Bulanan</button>
                <button type="submit" name="tahunan">Tahunan</button>
            </form>

                <!-- <a class="section-a" href="report_harian.php">Harian</a>
                <a class="section-a" href="report_bulanan.php">Bulanan</a>
                <a class="section-a" href="report_tahunan.php">Tahunan</a>
                <a class="section-a" href="report_keuangan.php">Laporan Keuangan</a> -->
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
    
    const dataNo = <?= json_encode($no) ?>;
    const dataJumlah = <?= json_encode($jumlah) ?>;
        
    // const data = json_encode($data);
    // const dataMingguan = json_encode($dataMingguan);
    // const dataTahunan = json_encode($dataTahunan);

    // Chart 1: Statistik Bulanan (Donut Chart)
    const ctx1 = document.getElementById('chartPengunjung').getContext('2d');
    new Chart(ctx1, {
        type: 'doughnut',
        data: {
            labels: Object.keys(dataNo), // Ambil label dari kunci dataBulanan
            datasets: [{
                data: Object.values(dataJumlah), // Ambil nilai dari dataBulanan
                backgroundColor: ['#4caf50', '#2196f3', '#ffeb3b', '#f44336', '#9c27b0', '#ff9800', '#00bcd4'],
            }]
        }
    });

    // Chart 2: Statistik Mingguan (Bar Chart)
    const ctx2 = document.getElementById('chartPengunjung').getContext('2d');
    new Chart(ctx2, {
        type: 'bar',
        data: {
            labels: Object.keys(dataMingguan), // Ambil label dari kunci dataMingguan
            datasets: [{
                label: 'Pengunjung',
                data: Object.values(dataMingguan), // Ambil nilai dari dataMingguan
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

    // Chart 3: Statistik Tahunan (Line Chart)
    const ctx3 = document.getElementById('chartPengunjung').getContext('2d');
    new Chart(ctx3, {
        type: 'line',
        data: {
            labels: Object.keys(dataTahunan), // Ambil label dari kunci dataTahunan
            datasets: [{
                label: 'Pengunjung',
                data: Object.values(dataTahunan), // Ambil nilai dari dataTahunan
                borderColor: '#ff9800',
                backgroundColor: 'rgba(255, 152, 0, 0.5)',
                fill: true
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