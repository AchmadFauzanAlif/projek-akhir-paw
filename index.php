<?php
include "function.php";
session_start();

if (isset($_POST["pesan-tiket"])) {
    if (empty($_SESSION["user"])) {
        header("Location: user/login.php");
        exit();
    } else {
        header("Location: tiket/tiket.php?");
        exit();
    }
}

if (!empty($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $pelanggan = query("SELECT * FROM users WHERE id = $id");
}



if(isset($_POST["cek-pembayaran"])) {
    header("Location: pembayaran/cek_pembayaran.php");
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
                        <li class="nav-item"><a class="nav-link" href="tiket/tiket.php">Tiket</a></li>
                        <li class="nav-item"><a class="nav-link" href="contact.php">Kontak</a></li>
                    </ul>
                <?php elseif (!empty($_SESSION["user"])) : ?>
                    <ul class="navbar-nav position-absolute top-50 start-50 translate-middle ">
                        <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="tiket/tiket.php">Tiket</a></li>
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

    <div class="hero-section">
        <div class="container">
            <h3>Pulau Gili Labak</h3>
            <h1>Nikmati Salah Satu Keindahan di <br>Pulau Madura yang Menenangkan Jiwa</h1>
            <?php if (!empty($_SESSION["user"])) : ?>
                <form action="" method="post">

                    <?php foreach ($pelanggan as $row) : ?>
                        <a type="submit" href="tiket/tiket.php?id=<?= $row["id"] ?>" class="btn btn-light mt-4">Pesan Tiket</a>
                        <a type="submit" href="tiket/tiket.php?id=<?= $row["id"] ?>" class="btn btn-light mt-4">Cek Pembayaran</a>
                    <?php endforeach; ?>

                </form>
            <?php elseif (empty($_SESSION["user"])) : ?>
                <form action="" method="post">
                    <button type="submit" name="pesan-tiket" class="btn btn-light mt-4">Pesan Tiket</button>
                </form>
            <?php endif; ?>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>