<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nama  = $_POST["nama"];
    $email = $_POST["email"];
    $pesan = $_POST["pesan"];

    file_put_contents("pengaduan.txt",
        "Nama: $nama\nEmail: $email\nPesan: $pesan\n---\n",
        FILE_APPEND
    );

    echo "OK";
    exit;
}
?>
