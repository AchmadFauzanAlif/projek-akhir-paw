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
    <link rel="icon" type="../image/png" href="../img/logoGili.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../style/style_cekPembayaran.css" rel="stylesheet">
</head>

<body>
<nav class="navbar navbar-expand-sm navbar-dark fixed-top bg-primary">
        <div class="container">
            <div class="logo">
                <img src="img/logoGili.png" alt="Gili Labak Logo">
                <a class="navbar-brand" href="../index.php">Gili Labak</a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <?php if (empty($_SESSION["user"])) : ?>
                    <ul class="navbar-nav position-absolute top-50 start-50 translate-middle ">
                        <li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="../about.php">Tentang</a></li>
                        <li class="nav-item"><a class="nav-link" href="../user/login.php">Tiket</a></li>
                        <li class="nav-item"><a class="nav-link" href="../contact.php">Kontak</a></li>
                    </ul>
                <?php elseif (!empty($_SESSION["user"])) : ?>
                    <ul class="navbar-nav position-absolute top-50 start-50 translate-middle ">
                        <li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="../about.php">Tentang</a></li>
                        <li class="nav-item"><a type="submit" class="nav-link" href="../tiket/tiket.php?id=<?= $pelanggan["id"] ?>">Tiket</a></li>
                        <li class="nav-item"><a class="nav-link" href="../contact.php">Kontak</a></li>
                        <?php if (isset($_SESSION["level"]) && $_SESSION["level"] === "1") : ?>
                            <li class="nav-item"><a class="nav-link" href="../report.php">Report</a></li>
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

    <div class="status-container">
        <h2>Status Pemesanan</h2>
        <div class="table-container">
            <table>
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
                            <td>
                                <!-- Tombol untuk memunculkan tabel -->
                                <button class="btn btn-primary toggle-table" type="button" data-id="<?= $row['id'] ?>" data-tickets="<?= $row['jumlah_tiket'] ?>">
                                    <?= $row["jumlah_tiket"] ?>
                                </button>
                            </td>
                            <td><?= $row["waktu_transaksi"] ?></td>
                            <td><?= $row["telp"] ?></td>
                            <td><?= $row["tipe_tiket"] ?></td>
                            <td><?= $row["status_pembayaran"] ?></td>
                            <td>
                                <?php if ($row["status_pembayaran"] == 'Pending') : ?>
                                    <a href="detail_pembayaran.php?id=<?= $row['id'] ?>">Bayar</a>
                                <?php elseif ($row['status_pembayaran'] == 'Sukses') : ?>
                                    <a href="cetak_tiket.php?id=<?= $row['id'] ?>">Cetak</a>
                                <?php endif; ?>
                            </td>
                        </tr>

                        <!-- Kontainer untuk tabel dropdown -->
                        <tr id="dropdown-container-<?= $row['id'] ?>" style="display: none;">
                            <td colspan="8">
                                <div class="dropdown-table-container">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Pengunjung</th>
                                                <th>Telepon</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody id="dropdown-table-body-<?= $row['id'] ?>">
                                            <!-- Konten akan dimasukkan oleh JavaScript -->
                                        </tbody>
                                    </table>
                                </div>
                            </td>
                        </tr>
                    <?php $i++;
                    endforeach; ?>
                </tbody>

            </table>

        </div>
        <div>
            <a href="../index.php" class="btn">Kembali</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const toggleButtons = document.querySelectorAll('.toggle-table');

            toggleButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const tickets = parseInt(this.getAttribute('data-tickets'), 10);
                    const container = document.getElementById(`dropdown-container-${id}`);
                    const tableBody = document.getElementById(`dropdown-table-body-${id}`);

                    // Toggle visibilitas tabel
                    if (container.style.display === 'none') {
                        container.style.display = 'table-row';

                        // Cek apakah tabel sudah memiliki data, jika tidak, tambahkan data
                        if (tableBody.children.length === 0) {
                            for (let i = 1; i <= tickets; i++) {
                                const row = document.createElement('tr');
                                row.innerHTML = `
                                <td>${i}</td>
                                <td>Nama Pengunjung ${i}</td>
                                <td>085xxxxxxxxx</td>
                                <td>
                                    <a href="edit_pengunjung.php?id=${id}&no=${i}" class="btn btn-warning btn-sm">Edit</a>
                                    <a href="hapus_pengunjung.php?id=${id}&no=${i}" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                                </td>
                            `;
                                tableBody.appendChild(row);
                            }
                        }
                    } else {
                        container.style.display = 'none';
                    }
                });
            });
        });
    </script>



</body>

</html>