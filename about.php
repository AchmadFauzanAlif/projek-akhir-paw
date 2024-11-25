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
        .content-section {
            padding-top: 100px; /* Space between navbar and content */
            margin-bottom: 30px;
        }

        .content-section h2 {
            margin-bottom: 30px;
            text-align: center;
        }

        .content-img {
            display: flex;
            flex-direction: column;
            gap: 40px;
        }

        .wrapper {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 20px;
        }

        .wrapper img {
            width: 300px;
            height: auto;
            border-radius: 10px;
        }

        .wrapper h5 {
            margin: 0;
            font-size: 1.2rem;
        }

        .wrapper p.img-caption {
            font-size: 0.9rem;
            color: #ffff;
            padding-top: 20px;
        }

        .wrapper:nth-child(odd) {
            flex-direction: row;
        }

        .wrapper:nth-child(even) {
            flex-direction: row-reverse;
        }

        @media (max-width: 768px) {
            .wrapper {
                flex-direction: column !important;
                align-items: center;
            }

            .wrapper img {
                width: 100%;
                max-width: 400px;
            }
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
