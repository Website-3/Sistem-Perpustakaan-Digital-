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
    <title>Contact - SIPUS</title>
    <?php include 'components/head.php'; ?>
    <link rel="stylesheet" href="assets/css/contact.css">
</head>

<body>

<?php include 'components/navbar.php'; ?>

<div class="contact-wrapper">

    <div class="card">
        <h2>Kontak Kami</h2>
        <p>Email: <b>sipus@unila.ac.id</b></p>
        <p>Telepon: <b>085278697835</b></p>
        <p>Alamat: Gedung Perpustakaan Universitas Lampung</p>
        <a href="index.php" class="back-btn">Kembali</a>
    </div>

    <div class="report-box">
        <h3>Kotak Pengaduan</h3>

        <form id="reportForm">
            <input type="text" name="nama" class="input-field" placeholder="Nama Anda" required>
            <input type="email" name="email" class="input-field" placeholder="Email Anda" required>
            <textarea name="pesan" class="input-field text-area" placeholder="Tulis pesan..." required></textarea>
            <button type="submit" class="send-btn">Kirim Pengaduan</button>
        </form>
    </div>
    
</div>

<?php include 'components/footer.php'; ?>

<div class="popup" id="successPopup">
    <h3>Pesan Terkirim!</h3>
    <p>Terima kasih, pesan Anda telah kami terima.</p>
</div>

<script src="assets/js/contact.js"></script>
</body>
</html>
