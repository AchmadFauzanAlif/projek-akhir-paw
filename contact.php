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
    <link rel="stylesheet" href="style/style_contact.css">
</head>

<body>
    
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
                <?php if (empty($_SESSION["user"])) : ?>
                    <ul class="navbar-nav position-absolute top-50 start-50 translate-middle ">
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.php">Tentang</a></li>
                        <li class="nav-item"><a class="nav-link" href="user/login.php">Tiket</a></li>
                        <li class="nav-item"><a class="nav-link" href="contact.php">Kontak</a></li>
                    </ul>

                <?php elseif (!empty($_SESSION["user"])) : ?>
                    <ul class="navbar-nav position-absolute top-50 start-50 translate-middle ">
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="nav-item"><a type="submit" class="nav-link" href="tiket/tiket.php?id=<?= $pelanggan["id"] ?>">Tiket</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.php">Tentang</a></li>
                        <li class="nav-item"><a class="nav-link" href="contact.php">Kontak</a></li>
              
                        <?php if (isset($_SESSION["level"]) && $_SESSION["level"] === "1") : ?>
                            <li class="nav-item"><a class="nav-link" href="report.php">Report</a></li>
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
    <main>
        <section class="contact-container">
            <section class="contact-container-2">

                <h2>Kontak Kami</h2>
                <br>
                <p>Informasi kontak admin Tiket Wisata Sumenep dan form feedback yang dapat dilihat oleh admin</p>
                <br>
                <div class="contact-content">
                    <!-- Form Feedback -->
                    <div class="form-section">
                        <h3>Form Feedback</h3>
                        <form action="feedback.php" method="POST">
                            <div class="form-group">
                                <label for="nama">Nama Lengkap</label>
                                <input type="text" id="nama" name="nama" placeholder="Nama Anda" required>
                            </div>
                            <div class="form-group">
                                <label for="telepon">No.Telepon</label>
                                <input type="text" id="telepon" name="telepon" placeholder="Nomor Telepon" required>
                            </div>
                            <div class="form-group">
                                <label for="kategori">Kategori</label>
                                <select id="kategori" name="kategori">
                                    <option value="pertanyaan">Pertanyaan</option>
                                    <option value="keluhan">Keluhan</option>
                                    <option value="saran">Saran</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" placeholder="Email Anda" required>
                            </div>
                            <div class="form-group">
                                <label for="pesan">Isi Pesan</label>
                                <textarea id="pesan" name="pesan" placeholder="Tulis pesan Anda" rows="4"></textarea>
                            </div>
                            <button type="submit" class="btn">Kirim Masukan</button>
                        </form>
                    </div>
                    <!-- Informasi Kontak -->
                    <div class="info-section">
                        <h3>Informasi Kontak</h3>
                        <br>
                        <div class="lokasi">
                            <p>
                                <img src="img/logo lokasi.png" alt="Logo Lokasi">
                                Kecamatan Talang, Kabupaten Sumenep, Madura, Jawa Timur.
                            </p>
                        </div>
                        <br>
                        <div class="kontak_admin">
                            <p>
                                <img src="img/logo telepon.png" alt="Logo Telepon">
                                08977-XXX-XXX (UPDT Pengelolah wisata Sumenep)
                            </p>
                            <br>
                            <p>
                                <img src="img/logo email.webp" alt="Logo Email">
                                sumenepkab.go.id
                            </p>
                        </div>
                        <br><br><br><br><br><br>
                        <!-- Sosial Media -->
                        <h4 class="header-sosial-media">Sosial Media</h4>
                        <div class="social-media">
                            <a href="https://instagram.com" target="_blank">
                                <img src="img/logo instagram.jpeg" alt="Instagram">
                            </a>
                            <a href="https://facebook.com" target="_blank">
                                <img src="img/logo facebook.png" alt="Facebook">
                            </a>
                            <a href="https://twitter.com" target="_blank">
                                <img src="img/logo twitter.jpeg" alt="Twitter">
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        </section>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>