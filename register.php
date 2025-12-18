<?php session_start();
require "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama     = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email    = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = $_POST['password'];

    $cek = mysqli_query($koneksi, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($cek) > 0) {
        $error = "Email sudah terdaftar!";
    } else {

        $hash = password_hash($password, PASSWORD_DEFAULT);

        $query = mysqli_query($koneksi, 
            "INSERT INTO users (username, email, password, role) 
             VALUES ('$nama', '$email', '$hash', 'user')"
        );

        if ($query) {
            $success = "Pendaftaran berhasil! Silakan login.";
        } else {
            $error = "Terjadi kesalahan.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>SIPUS - Perpustakaan Universitas</title>
    <?php include 'components/head.php'; ?>
    <link rel="stylesheet" href="assets/css/register.css">

    
</head>
<?php include 'components/head.php'; ?>
<body>
<?php include 'components/navbar.php'; ?>

    <div class="login-box">
        <h2>Daftar Akun</h2>

        <?php if (!empty($error)): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
            <p class="success"><?= $success ?></p>
        <?php endif; ?>

        <form method="POST">
            <input type="text" name="nama" placeholder="Nama Lengkap" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required autocomplete="new-password">
            <button type="submit">Daftar</button>
        </form>

        <a class="link-login" href="login.php">Sudah punya akun? Login</a>
    </div>

    <?php include 'components/footer.php'; ?>

<div id="popup" class="popup">
    <div class="popup-content">
        <p id="popup-message"></p>
        <button onclick="closePopup()">OK</button>
    </div>
</div>
<script src="assets/js/register.js"></script>


</body>
</html>
