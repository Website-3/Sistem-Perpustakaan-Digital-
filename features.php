<?php session_start(); 

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
    <title>Features - SIPUS</title>
    <?php include 'components/head.php'; ?>
    <link rel="stylesheet" href="assets/css/features.css">
</head>

<body>

<?php include 'components/navbar.php'; ?>

<div class="card" id="mainCard">
    <h2>Fitur SIPUS</h2>

    <div class="features-grid">
        <div class="feature-box"><img src="assets/img/koleksi.jpg"><h3>Koleksi Buku</h3></div>
        <div class="feature-box"><img src="assets/img/status.jpg"><h3>Status Buku</h3></div>
        <div class="feature-box"><img src="assets/img/informasi.jpg"><h3>Informasi Perpustakaan</h3></div>
    </div>

   <a href="index.php" class="back-btn">Kembali</a>
</div>

<?php include 'components/footer.php'; ?>

<script src="assets/js/features.js"></script>
</body>
</html>
