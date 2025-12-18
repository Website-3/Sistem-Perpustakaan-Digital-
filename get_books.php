<?php
require "koneksi.php";

header("Content-Type: application/json; charset=UTF-8");

$query = mysqli_query($koneksi, "SELECT * FROM buku ORDER BY judul ASC");

$data = [];
while ($row = mysqli_fetch_assoc($query)) {
    $data[] = [
        "id" => $row['id'],
        "judul" => $row['judul'],
        "penulis" => $row['penulis'],
        "tahun" => $row['tahun'],
        "status" => strtolower($row['status']), 
        "tanggal_kembali" => $row['tanggal_kembali'],
    ];
}

echo json_encode($data, JSON_PRETTY_PRINT);
exit;
