<?php session_start();
require "koneksi.php";

if (!isset($_GET['token'])) {
    die("Token tidak ditemukan!");
}

$token = $_GET['token'];

$cek = mysqli_query($koneksi, "SELECT * FROM users WHERE reset_token='$token'");
if (mysqli_num_rows($cek) !== 1) {
    die("Token tidak valid!");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    mysqli_query($koneksi, "UPDATE users SET password='$password', reset_token=NULL WHERE reset_token='$token'");

    echo "<script>
            alert('Password berhasil direset!');
            window.location='login.php';
          </script>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>SIPUS - Perpustakaan Universitas</title>
    <?php include 'components/head.php'; ?>
    <link rel="stylesheet" href="assets/css/reset_password.css">


</head>

<body>
<?php include 'components/navbar.php'; ?>


<div class="container fade">
    <h2>Reset Password</h2>

    <form method="POST">
        <input type="password" name="password" placeholder="Password Baru" required>
        <button type="submit">Reset Password</button>
    </form>

    <p><a href="login.php">Kembali ke Login</a></p>
</div>
<?php include 'components/footer.php'; ?>


</body>
</html>
