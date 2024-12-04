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
if($_SESSION['level'] == '1') {
    header("Location: ../index.php");
    exit();
}

// filter tidak boleh masuk lewat link / jika tidak mengirimkan id pemesanan tidak boleh masuk
$pemesananId = $_GET["id"];
if(empty($pemesananId)) {
    header("Location: cek_pembayaran.php");
    exit();
} 

// menampilkan data pemesanan
$pemesanan = query("SELECT * FROM pemesanan WHERE id = $pemesananId");
// var_dump($pemesanan);
// die;

// menentukan harga per 1 tiket
$tipeTiket = $pemesanan[0]["tipe_tiket"];

$harga = 0;
if($tipeTiket === 'Normal') {
    $harga = 110000;
} elseif ($tipeTiket === "VIP") {
    $harga = 250000;
} elseif ($tipeTiket === 'VVIP') {
    $harga = 400000;
}

$jumlahTiket = $pemesanan[0]["jumlah_tiket"];
$totalHarga = $jumlahTiket * $harga;

// Memasukkan data ke tabel pembayaran
if(isset($_POST['bayar'])) {
    $metodePembayaran = $_POST["metode-pembayaran"];
    $nopol = $_POST["nopol"];
    $totalHarga = $_POST["total-harga"];
    $pemesananId = $_POST["pesanan-id"];

    $pembayaran = "INSERT INTO pembayaran VALUES (NULL, '$metodePembayaran', '$nopol', '$totalHarga', '$pemesananId')";

    if(mysqli_query($conn, $pembayaran)) {
        echo "<script>alert('Data berhasil ditambahkan');</script>";
        header("Location: cek_pembayaran.php");
        exit();
    } else {
        echo "<script>alert('Data Gagal ditambahkan');</script>";
    }

}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gili Labak</title>
    <link href="../style/style.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="../img/logoGili.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .content-section {
            margin-top: 100px;
            text-align: center;
        }

        .card-custom {
            background: rgba(0, 0, 0, 0.8);
            color: white;
            border: none;
        }

        .btn-green {
            background-color: #28a745;
            color: white;
            border: none;
        }

        .btn-green:hover {
            background-color: #218838;
        }

        .info-card {
            background-color: #3a3a85;
            padding: 20px;
            border-radius: 8px;
            color: #fff;
        }

        .logo-gili {
            width: 60px;
            margin: 0 auto 10px;
        }

        .info-card img {
            display: block;
            width: 50px;
        }

        .info-card p {
            margin-top: 10px;
        }

        .payment-detail {
            font-size: 16px;
        }

        .payment-detail span {
            float: right;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-sm navbar-dark fixed-top">
        <div class="container">
            <div class="d-flex align-items-center">
                <img src="../img/logoGili.png" alt="Logo" width="40" height="40" class="me-2">
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
                </ul>
                <div class="d-flex align-items-center">
                    <span class="theme-icon me-3">🌙</span>
                <?php if(!empty($_SESSION["user"])) : ?>
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

    <!-- Content Section -->
    <div class="content-section container">
        <div class="row">
            <!-- Payment Details -->
            <div class="col-md-6">
                <div class="card card-custom p-3">
                    <h5 class="card-title">Detail pembayaran</h5>
                <?php foreach($pemesanan as $row) : ?>
                    <div class="payment-detail">
                        <p>Nama <span>Dicky Prasetyo</span></p>
                        <p>Tgl booking <span><?= $row["waktu_transaksi"] ?></span></p>
                        <p>Tipe Tiket <span><?= $row["tipe_tiket"] ?></span></p>

                        <p>Harga Tiket <span>Rp <?= $harga ?></span></p>
                        <hr>

                        <form action="" method="post">
                            <input type="hidden" name="pesanan-id" value="<?= $pemesananId ?> ">

                            <p>Total <span>Rp <?= $totalHarga ?></span></p>
                            <input type="hidden" name="total-harga" value="<?= $totalHarga ?>">

                            <?php if($tipeTiket == "VIP" || $tipeTiket == "VVIP") : ?>
                                <label id="nopol">Masukkan Nomer Polisi : </label>
                                <input type="number" name="nopol" id="nopol" required>
                            <?php elseif($tipeTiket == "Normal") : ?>
                                <input type="hidden" name="nopol" value="0">
                            <?php endif; ?>

                            <label for="">Metode Pembayaran</label>
                            <select name="metode-pembayaran" required>
                                <option value="" disabled selected>Pilih Metode Pembayaran</option>
                                <option value="dana">Dana</option>
                                <option value="gopay">GoPay</option>
                                <option value="bni">BNI</option>
                                <option value="bri">BRI</option>
                                <option value="bca">BCA</option>
                                <option value="mandiri">MANDIRI</option>
                            </select>

                            <button type="submit" class="btn btn-green mt-3" name="bayar">Bayar</button>
                        </form>
                    </div>
                <?php endforeach; ?>
                </div>
            </div>

            <!-- Info Section -->
            <div class="col-md-6">
                <div class="info-card text-center">
                    <div class="logo-gili">
                        <img src="../img/logoGili.png" alt="Logo">
                    </div>
                    <p>Setelah Anda menyelesaikan transaksi ini, metode pembayaran Anda akan didebit, dan Anda akan menerima pesan notifikasi yang mengonfirmasi penerimaan pembelian Anda.</p>
                </div>
                <div class="info-card">
                    <a href="cek_pembayaran.php">Kembali</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>