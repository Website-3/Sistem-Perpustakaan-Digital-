<?php
header('Content-Type: application/json');
require 'koneksi.php';

$query = "SELECT * FROM buku";
$result = mysqli_query($koneksi, $query);

$data = [];

while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

echo json_encode($data);
?>
