<?php
session_start();

if(empty($_SESSION["user"])) {
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
    <link rel="icon" type="image/png" href="img/logoGili.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../style/style.css" rel="stylesheet">
    <link href="../style/style_tiket.css" rel="stylesheet">
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
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="../index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="../about.php">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="../contact.php">Kontak</a></li>
                    <li class="nav-item"><a class="nav-link" href="../report.php">Report</a></li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <button class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                            <span>Hallow <?= $_SESSION["user"] ?></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item text-danger" href="logout.php" onclick="return confirm('Apakah Anda yakin ingin logout?')">Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section">
        <!-- Ticket Section -->
        <div class="container ticket-section">
            <div class="ticket-card">
                <h4>Tiket Masuk</h4>
                <br>
                <p>Yang Didapat:</p>
                <ul>
                    <li>Tiket Masuk ke Gili Labak</li>
                    <li>parkir</li>
                    <li>Sewa Perahu</li>
                </ul>
                <div class="price">Rp 110.000</div>
                <button>Pesan Tiket</button>
            </div>
            <div class="ticket-card">
                <h4>Tiket VIP</h4>
                <br>
                <p>Yang didapat:</p>
                <ul>
                    <li>Tiket Masuk Ke Gili Labak</li>
                    <li>Parkir</li>
                    <li>Sewa Perahu</li>
                    <li>Snorkeling</li>
                </ul>
                <div class="price">Rp 250.000</div>
                <button>Pesan Tiket</button>
            </div>
            <div class="ticket-card">
                <h4>Tiket VVIP</h4>
                <br>
                <p>Tiket VVIP termasuk semua fasilitas VIP plus Kuliner</p>
                <div class="price">Rp 400.000</div>
                <button>Pesan Tiket</button>
            </div>
        </div>
        <!-- User Profile Section -->
        <div class="container mt-5">
            <div class="user-profile">
                <h5>Pemesanan Tiket</h5>
                <form>
                    <label for="Nama">Nama</label>
                    <input type="text" placeholder="Nama" name="Nama">
                    <label for="Nomor Telp">Nomor Telp</label>
                    <input type="number" placeholder="Nomor Telp" name="Nomor Telp">
                    <label for="date">Tgl Booking</label>
                    <input type="date" placeholder="Tgl booking" name="date">
                    <label for="tipe tiket">Tipe Tiket</label>
                    <select>
                        <option>Pilih tipe tiket</option>
                        <option value="tiket-masuk">Tiket Masuk</option>
                        <option value="tiket-vip">Tiket VIP</option>
                        <option value="tiket-vvip">Tiket VVIP</option>
                    </select>
                    <button type="submit" name="pesan-tiket">Pesan</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>