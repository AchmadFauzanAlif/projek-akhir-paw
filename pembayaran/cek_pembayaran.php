<?php
session_start();
include "../function.php";


# Penambahan agar user tidak bisa masuk
if (empty($_SESSION["user"])) {
    header("Location: ../user/login.php");
    exit();
}

// filter user
if ($_SESSION['level'] == '1') {
    header("Location: ../index.php");
    exit();
}

//  Mengambil data di pemesanan lalu ditambilkan ke tabel
$id = $_SESSION['id'];
$pelanggan = query("SELECT * FROM pelanggan WHERE user_id = $id")[0];
$pelangganId = $pelanggan["id"];
$pemesanan = query("
    SELECT 
        pemesanan.id,
        pemesanan.jumlah_tiket,
        pemesanan.waktu_transaksi,
        pemesanan.telp,
        pemesanan.tipe_tiket,
        pemesanan.pelanggan_id,
        pelanggan.nama,
        pemesanan.status_pembayaran
    FROM 
        pemesanan
    JOIN 
        pelanggan 
    ON 
        pemesanan.pelanggan_id = pelanggan.id
    WHERE 
        pelanggan.user_id = $id
");

// nomer untuk table
$i = 1;
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
                    <li class="nav-item"><a type="submit" class="nav-link" href="#">Tiket</a></li>
                    <li class="nav-item"><a class="nav-link" href="../contact.php">Kontak</a></li>

                    <!-- Sepertinya tidak berguna -->
                    <?php if (isset($_SESSION["level"]) && $_SESSION["level"] === "1") : ?>
                        <li class="nav-item"><a class="nav-link" href="../report.php">Report</a></li>
                    <?php endif; ?>

                </ul>
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
                                    href="../logout.php"
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

    <div class="status-container">
        <h2>Status Pemesanan</h2>
        <div class="table-container">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>Jumlah Tiket</th>
                        <th>Tgl Booking</th>
                        <th>Telp</th>
                        <th>Tipe Tiket</th>
                        <th>Status Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pemesanan as $row): ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $row["nama"] ?></td>
                            <td><?= $row["jumlah_tiket"] ?></td>
                            <td><?= $row["waktu_transaksi"] ?></td>
                            <td><?= $row["telp"] ?></td>
                            <td><?= $row["tipe_tiket"] ?></td>

                            
                            <td><?= $row["status_pembayaran"] ?></td>

                            <?php if($row["status_pembayaran"] == 'Pending') : ?>
                            <td>
                                <a href="detail_pembayaran.php?id=<?php echo $row["id"] ?>">Bayar</a>
                            </td>
                            <?php elseif($row['status_pembayaran'] == 'Sukses') : ?>
                            <td>
                                <a href="cetak_tiket.php?id=<?= $row["id"] ?>">Cetak</a>
                            </td>
                            <?php endif; ?>

                        </tr>
                        <?php $i += 1; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <button name="kembali" onclick="location.href='../index.php'" class="mt-3 btn btn-secondary">Kembali</button>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>