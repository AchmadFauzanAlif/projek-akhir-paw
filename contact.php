<?php
session_start();

if (isset($_POST["login"])) {
    if (empty($_SESSION["user"])) {
        header("Location: user/login.php");
    } 

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
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="style/style.css" rel="stylesheet">
    <style>
        .contact-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            position: fixed;
            /* Tetap terlihat saat di-scroll */
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 90%;
            /* Lebar responsif */
            max-width: 800px;
            /* Batas maksimum lebar */
            padding: 20px;
            background-color: #001f3f;
            color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .contact-container h2 {
            font-size: 2em;
            margin-bottom: 10px;
        }

        .contact-container p {
            margin-bottom: 20px;
        }

        .contact-content {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .form-section,
        .info-section {
            background-color: #002b63;
            padding: 20px;
            border-radius: 10px;
            width: 40%;
            box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
        }

        .form-section h3,
        .info-section h3 {
            color: #ffffff;
            margin-bottom: 10px;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            background-color: #003c83;
            color: #fff;
        }

        .btn {
            background-color: #ff5733;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .btn:hover {
            background-color: #ff392b;
        }

        .info-section {
            color: #ffffff;
        }

        .info-section p {
            margin-bottom: 10px;
        }

        .lokasi,
        .kontak_admin {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 20px;
        }

        .lokasi p,
        .kontak_admin p {
            display: flex;
            align-items: center;
            margin: 0;
        }

        .lokasi img,
        .kontak_admin img {
            width: 30px;
            height: 30px;
            margin-right: 10px;
            border-radius: 5%;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease;
        }

        .lokasi img:hover,
        .kontak_admin img:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        .header-sosial-media {
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 20px;
        }

        .social-media {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            margin-top: 20px;
        }

        .social-media a img {
            width: 50px;
            height: 50px;
            border-radius: 10%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .social-media a img:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        }
    </style>
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
                    <li class="nav-item"><a class="nav-link" href="report.php">Report</a></li>
                </ul>
            <?php elseif(!empty($_SESSION["user"])) : ?>
                <ul class="navbar-nav me-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="tiket/tiket.php">Tiket</a></li>
                    <li class="nav-item"><a class="nav-link" href="about.php">Tentang</a></li>
                    <li class="nav-item"><a class="nav-link" href="contact.php">Kontak</a></li>
                    <li class="nav-item"><a class="nav-link" href="report.php">Report</a></li>
                </ul>
            <?php endif; ?>
            <?php if(empty($_SESSION["user"])) : ?>
                    <span class="theme-icon me-3">🌙</span>
                    <form action="" method="post">
                        <button type="submit" name="login" class="btn btn-outline-light">Login</button>
                    </form>
                    
            <?php elseif(!empty($_SESSION["user"])) : ?>
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
            <?php endif; ?>
            </div>
        </div>
    </nav>
    
    <main>
        <section class="contact-container">
            <h2>Kontak Kami</h2>
            <p>Informasi kontak admin Tiket Wisata Sumenep dan form feedback yang dapat dilihat oleh admin</p>
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
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>