<?php
// Mulai sesi dan sertakan file koneksi database
session_start();
include "../db.php";
include "../function.php";



// Ambil data tiket berdasarkan ID pemesanan yang diteruskan via GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT p.id, p.jumlah_tiket, p.waktu_transaksi, p.tipe_tiket, pel.nama, pel.telp 
              FROM pemesanan p
              INNER JOIN pelanggan pel ON p.pelanggan_id = pel.id
              WHERE p.id = $id";
    $data_tiket = query($query);

    if (empty($data_tiket)) {
        echo "Data tiket tidak ditemukan.";
        exit;
    }

    $tiket = $data_tiket[0];
} else {
    echo "ID tiket tidak ditemukan.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Tiket</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../style/style_cetak_tiket.css">
</head>

<body>
    <div class="ticket">
        <h3><img src="../img/logoGili.png" alt="logoGili" height="40px">Wisata Gili Labak</h3>
        <p><strong>Nama:</strong> <?= $tiket['nama']; ?></p>
        <p><strong>No. Telepon:</strong> <?= $tiket['telp']; ?></p>
        <p><strong>Jumlah Tiket:</strong> <?= $tiket['jumlah_tiket']; ?></p>
        <p><strong>Tanggal Booking:</strong> <?= $tiket['waktu_transaksi']; ?></p>
        <p><strong>Tipe Tiket:</strong> <?= $tiket['tipe_tiket']; ?></p>
        <div class="qr-code">
            <img src="../img/barcode.png $tiket['id']; ?>" alt="QR Code">
        </div>
        <p style="text-align: center;">Kode Tiket: <?= uniqid("TKT-"); ?></p>
    </div>
    <script>
        window.print();
    </script>
</body>

</html>