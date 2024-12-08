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

// 
if (!empty($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $pelanggan = query("SELECT * FROM users WHERE id = $id")[0];
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

// Mengambil data di detail tiket
// var_dump($pemesanan);
$pemesanan[0]["id"];
// die();

$detailTiket = query("SELECT * FROM detail_tiket");
// var_dump($detailTiket[0]);
// die();

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
                    <li class="nav-item"><a type="submit" class="nav-link" href="../tiket/tiket.php?id=<?= $pelanggan["id"] ?>">Tiket</a></li>
                    <li class="nav-item"><a class="nav-link" href="../contact.php">Kontak</a></li>
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
            <table border="1" cellspacing="1">
                <thead class="thead-table">
                    <tr>
                        <th>No</th>
                        <th>Nama Pelanggan</th>
                        <th>Jumlah Tiket</th>
                        <th>Tgl Booking</th>
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
                            <td>
                                <!-- Tombol untuk memunculkan tabel -->
                                <button class="btn btn-primary toggle-table" type="button" data-id="<?= $row['id'] ?>" data-tickets="<?= $row['jumlah_tiket'] ?>">
                                    <?= $row["jumlah_tiket"] ?>
                                </button>
                            </td>
                            <td><?= $row["waktu_transaksi"] ?></td>
                            <td><?= $row["tipe_tiket"] ?></td>
                            <td><?= $row["status_pembayaran"] ?></td>
                            <td>
                                <?php if ($row["status_pembayaran"] == 'Pending') : ?>
                                    <a href="detail_pembayaran.php?id=<?= $row['id'] ?>"><button class="btn-bayar">Bayar</button></a>
                                <?php elseif ($row['status_pembayaran'] == 'Sukses') : ?>
                                    <a href="cetak_tiket.php?id=<?= $row['id'] ?>"><button class="btn-cetak">Cetak</button></a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <!-- Kontainer untuk tabel dropdown -->
                        <tr id="dropdown-container-<?= $row['id'] ?>" style="display: none;">
                        <td colspan="7">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Pengunjung</th>
                                        <th>Telepon</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="dropdown-table-body-<?= $row['id'] ?>">
                                    <!-- Konten akan dimuat oleh JavaScript -->
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    <?php $i++;
                    endforeach; ?>
                </tbody>
            </table>
        </div>
        <div>
        <a href="../index.php"><button class="btn-kembali">Kembali</button></a>
        </div>
    </div>
    <br><br>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButtons = document.querySelectorAll('.toggle-table');
            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const container = document.getElementById(`dropdown-container-${id}`);
                    const tableBody = document.getElementById(`dropdown-table-body-${id}`);
                    container.style.display = container.style.display === 'none' ? 'table-row' : 'none';

                    // Muat data hanya jika tabel belum dimuat sebelumnya
                    if (tableBody.children.length === 0) {
                        fetch(`get_detail_tiket.php?pemesanan_id=${id}`)
                            .then(response => response.json())
                            .then(data => {
                                tableBody.innerHTML = data.map((item, index) => `
                                    <tr>
                                        <td>${index + 1}</td>
                                        <td>${item.nama_pelanggan}</td>
                                        <td>${item.telp}</td>
                                        <td>
                                            <a href="edit_pengunjung.php?id=${item.id}" class="btn btn-warning btn-sm">Edit</a>
                                            <a href="hapus_pengunjung.php?id=${item.id}" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                                        </td>
                                    </tr>
                                `).join('');
                            });
                    }
                });
            });
        });

    </script>
</body>
</html> 
