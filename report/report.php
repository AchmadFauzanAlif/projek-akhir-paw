<?php
session_start();
include "../function.php";
include "../db.php";

$data = [];

if (isset($_POST["harian"])) {
    // Data Harian
    $queryHarian = "
        SELECT DATE(waktu_transaksi) AS tanggal, COUNT(*) AS total
        FROM pemesanan
        WHERE status_pembayaran = 'sukses'
        GROUP BY DATE(waktu_transaksi)";
        
    $result = mysqli_query($conn, $queryHarian);

    while ($row = mysqli_fetch_assoc($result)) {
        $data[$row['tanggal']] = $row['total'];
    }


} elseif (isset($_POST["mingguan"])) {
    // Data Mingguan (dibagi menjadi 4 grup)
    $queryMingguan = "
        SELECT WEEK(waktu_transaksi, 1) AS minggu, COUNT(*) AS total
        FROM pemesanan
        WHERE status_pembayaran = 'sukses' AND YEAR(waktu_transaksi) = YEAR(CURDATE())
        GROUP BY WEEK(waktu_transaksi, 1)";
    $result = mysqli_query($conn, $queryMingguan);

    // Inisialisasi array untuk menyimpan data dalam 4 grup
    $data = [
        'Minggu Pertama' => 0,
        'Minggu Kedua' => 0,
        'Minggu Ketiga' => 0,
        'Minggu Keempat' => 0
    ];

    // Proses data mingguan ke dalam 4 grup
    while ($row = mysqli_fetch_assoc($result)) {
        $minggu = $row['minggu'];
        $total = $row['total'];

        // Tentukan grup berdasarkan nomor minggu
        if ($minggu >= 1 && $minggu <= 13) {
            $data['Minggu Pertama'] += $total;
        } elseif ($minggu >= 14 && $minggu <= 26) {
            $data['Minggu Kedua'] += $total;
        } elseif ($minggu >= 27 && $minggu <= 39) {
            $data['Minggu Ketiga'] += $total;
        } elseif ($minggu >= 40 && $minggu <= 52) {
            $data['Minggu Keempat'] += $total;
        }
    }
} elseif (isset($_POST["bulanan"])) {
    // Data Bulanan
    $queryBulanan = "
        SELECT MONTH(waktu_transaksi) AS bulan, COUNT(*) AS total
        FROM pemesanan
        WHERE status_pembayaran = 'sukses' AND YEAR(waktu_transaksi) = YEAR(CURDATE())
        GROUP BY MONTH(waktu_transaksi)";
    $result = mysqli_query($conn, $queryBulanan);

    // Inisialisasi bulan 1-12 dengan 0
    for ($i = 1; $i <= 12; $i++) {
        $data[$i] = 0;
    }

    while ($row = mysqli_fetch_assoc($result)) {
        $data[$row['bulan']] = $row['total'];
    }
} elseif (isset($_POST["tahunan"])) {
    // Data Tahunan
    $queryTahunan = "
        SELECT YEAR(waktu_transaksi) AS tahun, COUNT(*) AS total
        FROM pemesanan
        WHERE status_pembayaran = 'sukses'
        GROUP BY YEAR(waktu_transaksi)";
    $result = mysqli_query($conn, $queryTahunan);

    while ($row = mysqli_fetch_assoc($result)) {
        $data[$row['tahun']] = $row['total'];
    }
}

echo "<script>
    const dataBulanan = " . json_encode($dataBulanan) . ";
    const dataMingguan = " . json_encode($dataMingguan) . ";
    const dataTahunan = " . json_encode($dataTahunan) . ";
</script>";


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan</title>
</head>
<body>
    <form action="" method="post">
        <button type="submit" name="harian">Harian</button>
        <button type="submit" name="mingguan">Mingguan</button>
        <button type="submit" name="bulanan">Bulanan</button>
        <button type="submit" name="tahunan">Tahunan</button>
    </form>

    <table border="1">
        <tr>
            <th>Rentang</th>
            <th>Total</th>
        </tr>
        <?php if (!empty($data)): ?>
            <?php foreach ($data as $rentang => $total): ?>
                <tr>
                    <td><?= htmlspecialchars($rentang) ?></td>
                    <td><?= htmlspecialchars($total) ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="2">Tidak ada data</td>
            </tr>
        <?php endif; ?>
    </table>
</body>
</html>
