<?php 
session_start();
include "function.php";


if (isset($_POST["login"])) {
    if (empty($_SESSION["user"])) {
        header("Location: user/login.php");
    }
    exit();
}

if (!empty($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $pelanggan = query("SELECT * FROM users WHERE id = $id")[0];
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
    <link href="style/style.css" rel="stylesheet">
    <link href="style/style_about.css" rel="stylesheet">
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-sm navbar-dark fixed-top bg-primary">
        <div class="container">
            <div class="logo">
                <img src="img/logoGili.png" alt="Gili Labak Logo">
                <a class="navbar-brand" href="index.php">Gili Labak</a>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <?php if(empty($_SESSION["user"])) : ?>
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Kontak</a></li>
                    <li class="nav-item"><a class="nav-link" href="user/login.php">Tiket</a></li>
                </ul>
            <?php elseif(!empty($_SESSION["user"])) : ?>
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a type="submit" class="nav-link" href="tiket/tiket.php?id=<?= $pelanggan["id"] ?>">Tiket</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Kontak</a></li>

                    <?php if (isset($_SESSION["level"]) && $_SESSION["level"] === "1") : ?>
                        <li class="nav-item"><a class="nav-link" href="report.php">Report</a></li>
                    <?php endif; ?>

                </ul>
            <?php endif; ?>
            <?php if(empty($_SESSION["user"])) : ?>
                    <span class="theme-icon me-3">🌙</span>
                    <form action="" method="post">
                        <button type="submit" name="login" class="btn btn-outline-light">Login</button>
                    </form>
                    
            <?php elseif(!empty($_SESSION["user"])) : ?>
                <ul class="navbar-nav ms-auto user-nav">
                    <li class="nav-item dropdown">
                        <button
                            class="btn btn-dark dropdown-toggle user-dropdown-btn"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <img
                                src="img/profil.png"
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

    <!-- Content Section -->
    <section class="content-section">
        <div class="container">
            <h2>Pulau Gili Labak</h2>
            <p>Gili Labak adalah sebuah pulau kecil menawan yang terletak di Selat Madura, tepatnya di sebelah tenggara Pulau Madura yang termasuk ke dalam wilayah administrasi Kecamatan Talango, Kabupaten Sumenep, Madura, Jawa Timur. Pulau ini memiliki luas sekitar 5 hektar.</p>
            <p>Keindahan Pulau Gili Labak mulai menarik perhatian para traveler yang menyukai lokasi wisata alami dan jauh dari kebisingan kota.</p>

            <div class="content-img">
                <!-- Snorkeling -->
                <div class="wrapper">
                    <img src="img/wisata.jpg" alt="Gili Labak 1">
                    <div>
                        <h5>Snorkeling</h5>
                        <p class="img-caption">Jernihnya air di Gili Labak membuat kita bisa dengan jelas menikmati pemandangan underwater saat snorkeling. Terumbu karang yang masih terjaga alami serta beragam ikan kecil akan meramaikan aktivitas snorkeling di perairan sekitar Gili Labak.</p>
                    </div>
                </div>

                <!-- Dermaga -->
                <div class="wrapper">
                    <img src="img/wisata(2).jpg" alt="Gili Labak 2">
                    <div>
                        <h5>Suasana Tenang di Dermaga Gili Labak</h5>
                        <p class="img-caption">Suasana tenang di dermaga Gili Labak yang sempurna untuk bersantai. Nikmati pemandangan laut biru yang jernih dan angin sepoi-sepoi, destinasi yang menawarkan kedamaian di tengah keindahan alam tropis.</p>
                    </div>
                </div>

                <!-- Kuliner -->
                <div class="wrapper">
                    <img src="img/kuliner-gili labak.jpg" alt="Gili Labak 3">
                    <div>
                        <h5>Kuliner</h5>
                        <p class="img-caption">Mencoba kelezatan hidangan lokal adalah salah satu aktivitas wajib di destinasi wisata. Nikmati ikan bakar dengan taburan bumbu khas lokal yang akan membuat Anda rindu untuk kembali ke Gili Labak.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
