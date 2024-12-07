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
</head>

<body>
    <!-- Navbar -->
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