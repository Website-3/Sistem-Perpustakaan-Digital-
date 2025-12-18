<?php session_start(); ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>SIPUS - Perpustakaan Universitas</title>
    <?php include 'components/head.php'; ?>
    <link rel="stylesheet" href="assets/css/index.css">
</head>

<body>

<video autoplay loop muted class="bg-video">
    <source src="assets/img/lib.mp4" type="video/mp4">
</video>
<div class="overlay-brown"></div>

<?php include 'components/navbar.php'; ?>

<section class="hero">
    <h1>Selamat Datang di SIPUS</h1>
    <p class="slogan">Jelajahi Dunia Pengetahuan dengan Mudah, Cepat, dan Lengkap.</p>
    <a href="login.php" class="btn">Login</a>
</section>

<h2 class="section-title">Buku Paling Banyak Dicari</h2>
<div class="book-container">
    <div class="book-card">
        <img src="assets/img/buku1.jpg">
        <h3>Filsafat Ilmu</h3>
        <p>120 kali dilihat</p>
    </div>
    <div class="book-card">
        <img src="assets/img/buku2.jpg">
        <h3>Algoritma & Struktur Data</h3>
        <p>95 kali dilihat</p>
    </div>
    <div class="book-card">
        <img src="assets/img/buku3.jpg">
        <h3>Jaringan Komputer</h3>
        <p>80 kali dilihat</p>
    </div>
</div>

<?php include 'components/footer.php'; ?>
<script src="assets/js/script.js"></script>
</body>
</html>
