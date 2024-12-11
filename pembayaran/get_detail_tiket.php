<?php
include "../db.php";

if (!empty($_GET['pemesanan_id'])) {
    $id = (int) $_GET['pemesanan_id'];

    // Query data detail tiket berdasarkan ID pemesanan
    $result = mysqli_query($conn, "SELECT id, nama_pelanggan, telp FROM detail_tiket WHERE transaksi_id = $id");
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    

    // Kirimkan data dalam format JSON
    header('Content-Type: application/json');
    echo json_encode($data);
} else {
    http_response_code(400);
    echo json_encode(['error' => 'ID tidak valid']);
}
