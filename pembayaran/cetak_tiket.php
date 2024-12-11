<?php
// Mulai sesi dan sertakan file koneksi database
session_start();
include "../db.php";
include "../function.php";

// Ambil data tiket berdasarkan ID pemesanan yang diteruskan via GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Query untuk mengambil data pemesanan
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

    // Query untuk mengambil detail tiket berdasarkan transaksi_id
    $query_detail = "SELECT * FROM detail_tiket WHERE transaksi_id = $id";
    $data_detail_tiket = query($query_detail);
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

    <?php if (!empty($data_detail_tiket)): ?>
        <?php foreach ($data_detail_tiket as $tiket_detail): ?>
            <div class="ticket">
                <h3><img src="../img/logoGili.png" alt="logoGili" height="40px">Wisata Gili Labak</h3>
                <p><strong>Nama:</strong> <?= $tiket_detail['nama_pelanggan']; ?></p>
                <p><strong>No. Telepon:</strong> <?= $tiket_detail['telp']; ?></p>
                <p><strong>Jumlah Tiket:</strong> <?= $tiket['jumlah_tiket']; ?></p>
                <p><strong>Tanggal Booking:</strong> <?= $tiket['waktu_transaksi']; ?></p>
                <p><strong>Tipe Tiket:</strong> <?= $tiket['tipe_tiket']; ?></p>

                <!-- <div class="qr-code">
                    <img src="../img/barcode.png" alt="QR Code">
                </div> -->

                <p style="text-align: center;">Kode Tiket: <?= uniqid("TKT-"); ?></p>
                <hr> <!-- Garis pemisah antar tiket -->
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Tidak ada detail tiket untuk transaksi ini.</p>
    <?php endif; ?>

    <script>
        window.print();
    </script>
</body>

</html>