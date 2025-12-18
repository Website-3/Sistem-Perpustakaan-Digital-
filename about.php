<?php
session_start();

$back = 'index.php';

if (!empty($_SERVER['HTTP_REFERER'])) {
    if (
        !str_contains($_SERVER['HTTP_REFERER'], 'login.php') &&
        !str_contains($_SERVER['HTTP_REFERER'], 'about.php')
    ) {
        $back = $_SERVER['HTTP_REFERER'];
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Tentang SIPUS</title>
    <?php include 'components/head.php'; ?>
    <link rel="stylesheet" href="assets/css/about.css">
</head>

<body>

<?php include "components/navbar.php"; ?>

<div class="page-container">

    <div id="aboutCard">
        <h2>Tentang SIPUS</h2>
        <p>
            SIPUS adalah Sistem Informasi Perpustakaan Universitas yang menyediakan akses cepat,
            modern, dan terintegrasi untuk melihat koleksi, melakukan peminjaman, serta mengakses
            seluruh layanan perpustakaan secara digital.
        </p>

       <a href="index.php" class="back-btn">Kembali</a>
    </div>

    <div class="section-title">Visi & Misi SIPUS</div>

    <div class="grid">
        <div class="card">
            <div class="card-title">Visi</div>
            <p>Menjadi sistem perpustakaan digital terbaik dengan pelayanan cepat, modern, dan mudah diakses kapan saja.</p>
        </div>
        <div class="card">
            <div class="card-title">Misi</div>
            <p>Mendukung kegiatan akademik melalui layanan informasi berkualitas, responsif, dan inovatif.</p>
        </div>
        <div class="card">
            <div class="card-title">Tujuan</div>
            <p>Meningkatkan kenyamanan dalam menggunakan layanan perpustakaan.</p>
        </div>
    </div>

</div>

<?php include "components/footer.php"; ?>
<script src="assets/js/about.js"></script>
</body>
</html>
