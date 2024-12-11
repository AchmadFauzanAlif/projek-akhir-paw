<?php
session_start();
include "../function.php";

// Aktifkan error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Cek apakah user sudah login
if (empty($_SESSION["user"])) {
    header("Location: ../user/login.php");
    exit();
}

// Cek apakah ID pengunjung ada di URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    die("ID pengunjung tidak valid.");
}

$id = intval($_GET['id']); // Pastikan ID adalah integer

// Ambil data pengunjung dari database
$pengunjung = query("SELECT * FROM detail_tiket WHERE id = $id");

if (!$pengunjung) {
    die("Pengunjung tidak ditemukan.");
}

$pengunjung = $pengunjung[0]; // Ambil data pengunjung pertama

// Proses form jika ada pengiriman data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama_pelanggan'];
    $telp = $_POST['telp'];

    // Update data pengunjung
    $update = "UPDATE detail_tiket SET nama_pelanggan = '$nama', telp = '$telp' WHERE id = $id";

    if (mysqli_query($conn, $update)) {
        header("Location: cek_pembayaran.php?message=Data berhasil diupdate");
        exit();
    } else {
        $error = "Gagal mengupdate data pengunjung.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pengunjung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Pengunjung</h2>
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Pengunjung</label>
                <input type="text" class="form-control" id="nama" name="nama_pelanggan" value="<?= htmlspecialchars($pengunjung['nama_pelanggan']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="telp" class="form-label">Telepon</label>
                <input type="text" class="form-control" id="telp" name="telp" value="<?= htmlspecialchars($pengunjung['telp']) ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
            <a href="cek_pembayaran.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>