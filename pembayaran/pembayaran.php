<?php 
session_start();

# Penambahan agar user tidak bisa masuk
if (empty($_SESSION["user"])) {
    header("Location: ../user/login.php");
    exit();
}

# filter user
if($_SESSION['level'] == '1') {
    header("Location: ../index.php");
    exit();
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
    <link href="../style/style_pembayaran.css" rel="stylesheet">

    <style>
        body {
            background: url('../img/background.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #fff;
        }

        .navbar {
            background-color: #2d2d96 !important;
        }

        .hero-section {
            padding-top: 100px;
            text-align: center;
        }

        .card-custom {
            background: rgba(0, 0, 0, 0.7);
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

        .payment-icons img {
            width: 50px;
            height: 35px;
            margin: 5px;
            border-radius: 5px;
        }

        .theme-icon {
            cursor: pointer;
        }

        .detail-pembayaran {
            padding: 5px;
            margin-left: 10px;
            margin-bottom: 100px;
            margin-right: 300px;
            border-radius: 5px;
            background-color: 00308e;
        }

        .info-pembayaran {
            padding: 5px;
            border-radius: 5px;
            background-color: 00308e;
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
    
    <div class="hero-section container">
        <div class="button-info">
            <a href="detail_pembayaran.php"><button class="detail-pembayaran">Detail Pembayaran</button></a>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card card-custom p-3">
                    <h5 class="card-title">Metode Pembayaran</h5>
                    <p>Kami menerima metode pembayaran aman berikut:</p>
                    <div class="payment-icons">

                        <img src="../img/logo bank.jpeg" alt="Bank">
                        <img src="../img/dana logo.jpg" alt="Dana">
                        <img src="../img/logo gopay.jpg" alt="GoPay">

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-custom p-3">
                    <h5 class="card-title">Metode Pembayaran</h5>
                    <form action="#" method="POST">
                        <label for="payment-method" class="form-label">Pilih metode pembayaran</label>
                        <select id="payment-method" name="payment_method" class="form-select">
                            <option value="dana">Dana</option>
                            <option value="bca">GoPay</option>
                            <option value="bni">BNI</option>
                            <option value="gopay">BRI</option>
                            <option value="gopay">BCA</option>
                            <option value="gopay">Bank MANDIRI</option>
                        </select>
                        <button type="submit" class="btn btn-green mt-3">Lanjutkan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>