<?php session_start();
require "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);

    $cek = mysqli_query($koneksi, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($cek) === 1) {

        $token = bin2hex(random_bytes(16));
        mysqli_query($koneksi, "UPDATE users SET reset_token='$token' WHERE email='$email'");

       header("Location: forgot_password.php?sent=1&go=$token");
exit();
    } else {
        $error = "Email tidak ditemukan!";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>SIPUS - Perpustakaan Universitas</title>
    <?php include 'components/head.php'; ?>
    <link rel="stylesheet" href="assets/css/forgot_password.css">


</head>
<?php include 'components/head.php'; ?>
<body>

<?php include 'components/navbar.php'; ?>
<div class="login-box">
    <h2>Lupa Password</h2>

    <?php if(isset($error)): ?>
        <p class="error"><?= $error ?></p>
    <?php endif; ?>

    <?php if(isset($_GET['sent'])): ?>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        showPopup("Link reset password berhasil dibuat!");

        setTimeout(() => {
            window.location = "reset_password.php?token=<?= $_GET['go'] ?>";
        }, 1800); 
    });
</script>
<?php endif; ?>

    <form method="POST">
        <input type="email" name="email" placeholder="Masukkan email Anda" required>
        <button type="submit">Kirim Link Reset</button>
    </form>

    <p style="margin-top:10px;">
        <a href="login.php" style="color:#5a3e2b;">Kembali ke Login</a>
    </p>
</div>
<?php include 'components/footer.php'; ?>
<div id="popup" class="popup">
    <div class="popup-content">
        <p id="popup-message"></p>
        <button onclick="closePopup()">OK</button>
    </div>
</div>
<script src="assets/js/forgot_password.js"></script>
</body>
</html>
