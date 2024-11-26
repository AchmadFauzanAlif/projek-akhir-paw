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
    <link href="style/style.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="img/logoGili.png">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .status-container {
            margin: 100px auto 0;
            max-width: 500px;
            background: rgba(255, 255, 255, 0.9);
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }
        .status-container h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #4b4b4b;
        }
        .table-container {
            overflow-x: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        .btn-payment {
            display: block;
            width: 100%;
            text-align: center;
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 0;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }
        .btn-payment:hover {
            background-color: #45a049;
        }
        .status {
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            color: red;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-sm navbar-dark fixed-top">
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
                    <li class="nav-item"><a class="nav-link" href="../tiket/tiket.php">Tiket</a></li>
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

    <!-- Status Pemesanan -->
    <div class="status-container">
        <h2>Status Pemesanan</h2>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Nomor Telp</th>
                        <th>Tgl Booking</th>
                        <th>Tipe Tiket</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="4" class="status">Belum Dibayar</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <a href="pembayaran.php"><button class="btn-payment">Pembayaran</button></a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
