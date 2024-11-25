<?php
session_start();

if (isset($_POST["pesan-tiket"]) || isset($_POST["history"])) {
    if (empty($_SESSION["user"])) {
        header("Location: login.php");
    } else {
        header("Location: add_tiket.php");
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
        body {
            font-family: Arial, sans-serif;
            padding-top: 100px;
        }

        .navbar {
            background-color: #004c8c;
        }

        .hero-section {
            background-size: cover;
            background-position: center;
            padding: 100px 0;
            text-align: center;
        }

        .hero-section h1 {
            font-size: 3rem;
            margin-bottom: 20px;
        }

        .hero-section h3 {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .ticket-section {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 100px;
            max-width: 1200px;
            /* Membatasi lebar maksimum */
            margin-left: auto;
            margin-right: auto;
        }

        .ticket-card {
            background-color: #ffffff;
            border-radius: 10px;
            color: black;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            flex: 1;
            /* Membuat semua kartu memiliki ukuran yang sama */
            max-width: 350px;
            /* Membatasi lebar kartu */
            text-align: center;
        }


        .ticket-card h4 {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .ticket-card p {
            font-size: 1rem;
            margin-bottom: 10px;
        }

        .ticket-card .price {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .ticket-card button {
            background-color: #004c8c;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            width: 100%;
            font-size: 1rem;
        }

        .user-profile {
            background-color: #ffffff;
            color: black;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 500px;
            /* Batas maksimum lebar form */
            margin: 50px auto;
            /* Membuat form berada di tengah halaman */
            text-align: left;
        }

        .user-profile h5 {
            font-size: 1.5rem;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .user-profile input,
        .user-profile select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .user-profile button {
            background-color: #004c8c;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            width: 100%;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .user-profile button:hover {
            background-color: #003366;
        }


        .btn-light {
            background-color: #ffffff;
            color: #004c8c;
            border: 2px solid #004c8c;
            padding: 10px 20px;
            font-size: 1rem;
            margin: 10px 5px;
            border-radius: 5px;
        }

        .theme-icon {
            font-size: 1.5rem;
        }

        @media (max-width: 768px) {
            .ticket-section {
                flex-direction: column;
                align-items: center;
            }

            .ticket-card {
                width: 100%;
                margin-bottom: 20px;
            }

            .user-profile {
                width: 100%;
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
                    <input type="text" placeholder="Nama" name="Nama" required>
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