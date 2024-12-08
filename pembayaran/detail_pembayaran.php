<?php
session_start();
include "../function.php";
include "../db.php";

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

// filter tidak boleh masuk lewat link / jika tidak mengirimkan id pemesanan tidak boleh masuk
$pemesananId = $_GET["id"];
if (empty($pemesananId)) {
    header("Location: cek_pembayaran.php");
    exit();
}

// menampilkan data pemesanan
$pemesanan = query("SELECT * FROM pemesanan WHERE id = $pemesananId");

// menentukan harga per 1 tiket
$tipeTiket = $pemesanan[0]["tipe_tiket"];

$harga = 0;
if ($tipeTiket === 'Normal') {
    $harga = 110000;
} elseif ($tipeTiket === "VIP") {
    $harga = 250000;
} elseif ($tipeTiket === 'VVIP') {
    $harga = 400000;
}

$jumlahTiket = $pemesanan[0]["jumlah_tiket"];
$totalHarga = $jumlahTiket * $harga;

// Memasukkan data ke tabel pembayaran
if (isset($_POST['bayar'])) {
    $metodePembayaran = $_POST["metode-pembayaran"];
    $nopol = $_POST["nopol"];
    $totalHarga = $_POST["total-harga"];
    $pemesananId = $_POST["pesanan-id"];

    // Menambahkan data ke database
    $pembayaran = "INSERT INTO pembayaran VALUES (NULL, '$metodePembayaran', '$nopol', '$totalHarga', '$pemesananId')";

    if (mysqli_query($conn, $pembayaran)) {
        // Mengupdate status pembayaran di tabel pemesanan
        $updatePemesanan = "UPDATE pemesanan SET status_pembayaran = 'Sukses' WHERE id = $pemesananId";

        if (mysqli_query($conn, $updatePemesanan)) {
            echo "<script>alert('Pembayaran berhasil, status pembayaran telah diperbarui.');</script>";
            header("Location: cek_pembayaran.php");
            exit();
        } else {
            echo "<script>alert('Pembayaran berhasil, tetapi gagal memperbarui status pembayaran.');</script>";
        }
    } else {
        echo "<script>alert('Data gagal ditambahkan ke tabel pembayaran.');</script>";
    }

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gili Labak</title>
    <!-- <link href="../style/style.css" rel="stylesheet"> -->
    <link rel="icon" type="image/png" href="../img/logoGili.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style/style_detailpembayaran.css">
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
                            <span class="user-greeting">Halo, <?= htmlspecialchars($_SESSION["user"]) ?></span>
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

    <!-- Content Section -->
    <div class="content-section container">
    <a href="cek_pembayaran.php"><button class="kembali">Cek Pembayaran</button></a>
        <div class="row">
            <!-- Payment Details -->
            <div class="col-md-6">
                <div class="card card-custom p-3">
                    <h5 class="card-title">Detail Pembayaran</h5>
                    <?php foreach ($pemesanan as $row) : ?>
                        <div class="payment-detail">
                            <form action="" method="post">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col">Deskripsi</th>
                                            <th scope="col">Detail</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Nama</td>
                                            <td>Dicky Prasetyo</td>
                                        </tr>
                                        <tr>
                                            <td>Tgl booking</td>
                                            <td><?= $row["waktu_transaksi"] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Tipe Tiket</td>
                                            <td><?= $row["tipe_tiket"] ?></td>
                                        </tr>
                                        <tr>
                                            <td>Harga Tiket</td>
                                            <td>Rp <?= number_format($harga, 0, ',', '.') ?></td>
                                        </tr>
                                        <tr>
                                            <td>Total</td>
                                            <td>Rp <?= number_format($totalHarga, 0, ',', '.') ?>
                                                <input type="hidden" name="total-harga" value="<?= $totalHarga ?>">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <input type="hidden" name="pesanan-id" value="<?= $pemesananId ?>">
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <?php if ($tipeTiket == "VIP" || $tipeTiket == "VVIP") : ?>
                                    <div class="mb-3">
                                        <label for="nopol">Masukkan Nomer Polisi:</label>
                                        <input type="text" name="nopol" id="nopol" class="form-control" required>
                                    </div>
                                <?php else : ?>
                                    <input type="hidden" name="nopol" value="0">
                                <?php endif; ?>

                                <div class="mb-3">
                                    <label for="metode-pembayaran" class="judul-metode-pembayaran">Metode Pembayaran</label>
                                    <div class="logo-pembayaran">
                                            <img src="../img/logo bank.jpeg" alt="logo">
                                            <img src="../img/dana logo.jpg" alt="logo">
                                            <img src="../img/logo gopay.jpg" alt="logo">
                                    </div>
                                    <select name="metode-pembayaran" class="form-select" required>
                                        <option value="" disabled selected>Pilih Metode Pembayaran</option>
                                        <option value="dana">Dana</option>
                                        <option value="gopay">GoPay</option>
                                        <option value="bni">BNI</option>
                                        <option value="bri">BRI</option>
                                        <option value="bca">BCA</option>
                                        <option value="mandiri">MANDIRI</option>
                                    </select>
                                </div>
                                <div class="mt-3 text-end">
                                    <button type="submit" class="btn btn-green" name="bayar">Bayar</button>
                                </div>
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>
                <br><br>
            </div>

            <!-- Info Section -->
            <div class="col-md-6">
                <div class="info-card text-center">
                    <div class="logo-gili">
                        <img src="../img/logoGili.png" alt="Logo">
                    </div>
                    <p>Setelah Anda menyelesaikan transaksi ini, metode pembayaran Anda akan didebit, dan Anda akan menerima pesan notifikasi yang mengonfirmasi penerimaan pembelian Anda.</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>