<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gili Labak</title>
    <link href="style/style.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="img/logoGili.png">
    <!-- Bootstrap CSS -->
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
            /* Beri jarak antara logo dan teks */
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
                <img src="img/logoGili.png" alt="Logo" width="40" height="40" class="me-2">
                <a class="navbar-brand" href="index.php">Gili Labak</a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="tiket.php">Tiket</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Kontak</a></li>
                    <li class="nav-item"><a class="nav-link" href="report.php">Report</a></li>
                </ul>
                <div class="d-flex align-items-center">
                    <span class="theme-icon me-3">🌙</span>
                    <a href="user/login.php" class="btn btn-outline-light">Login</a>
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
                    <div class="payment-detail">
                        <p>Nama <span>Dicky Prasetyo</span></p>
                        <p>Tgl booking <span>2024/11/25</span></p>
                        <p>Tipe Tiket <span>VVIP</span></p>
                        <p>Harga Tiket <span>Rp 400.000</span></p>
                        <hr>
                        <p>Subtotal <span>Rp 400.000</span></p>
                        <p>Total <span>Rp 400.000</span></p>
                        <p>Metode pembayaran <span>Dana <a href="pembayaran.php">(Ubah)</a></span></p>
                    </div>
                    <button type="button" class="btn btn-green mt-3">Bayar</button>
                </div>
            </div>

            <!-- Info Section -->
            <div class="col-md-6">
                <div class="info-card text-center">
                    <div class="logo-gili">
                        <img src="img/logoGili.png" alt="Logo">
                    </div>
                    <p>Setelah Anda menyelesaikan transaksi ini, metode pembayaran Anda akan didebit, dan Anda akan menerima pesan notifikasi yang mengonfirmasi penerimaan pembelian Anda.</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>