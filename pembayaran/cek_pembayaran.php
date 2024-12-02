<?php
session_start();

# Penambahan agar user tidak bisa masuk
if (empty($_SESSION["user"])) {
    header("Location: ../user/login.php");
    exit();
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gili Labak</title>
    <link href="style/style.css" rel="stylesheet">
    <link rel="icon" type="../image/png" href="../img/logoGili.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../style/style_cekPembayaran.css" rel="stylesheet">
</head>

<body>
    <nav class="navbar navbar-expand-sm navbar-dark fixed-top">
        <div class="container">
            <div class="logo">
                <img src="../img/logoGili.png" alt="Gili Labak Logo">
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="../tiket/tiket.php">Tiket</a></li>
                    <li class="nav-item"><a class="nav-link" href="../about.php">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="../contact.php">Kontak</a></li>
                    <li class="nav-item"><a class="nav-link" href="../report.php">Report</a></li>
                </ul>
                <div class="d-flex align-items-center">
                    <span class="theme-icon me-3">🌙</span>
                <?php if(empty($_SESSION["user"])) : ?>
                    <a href="user/login.php" class="btn btn-outline-light">Login</a>
                <?php elseif(!empty($_SESSION["user"])) : ?>
                    <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                <span>Hallow <?= $_SESSION["user"] ?></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item text-danger" href="../logout.php" onclick="return confirm('Apakah Anda yakin ingin logout?')">Logout</a>
                                </li>
                            </ul>
                <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <div class="status-container">
        <h2>Status Pemesanan</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Nomor Telp</th>
                        <th>Tgl Booking</th>
                        <th>Tipe Tiket</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <td colspan="4" class="status">Belum Dibayar</td>
                    </tr>

                    
                </tbody>
            </table>
        </div>
        <a href="pembayaran.php"><button class="btn-payment">Pembayaran</button></a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
