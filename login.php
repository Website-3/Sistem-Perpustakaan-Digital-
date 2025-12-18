<?php session_start();
require "koneksi.php"; 


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email    = mysqli_real_escape_string($koneksi, $_POST['email']);
    $password = $_POST['password'];
    $role     = $_POST['role'];

    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE email='$email'");
    $data  = mysqli_fetch_assoc($query);

    if ($data) {
        if (!password_verify($password, $data['password'])) {
            $error = "Password salah!";
        } 
        elseif ($data['role'] !== $role) {
            $error = "Role tidak sesuai!";
        } 
        else {
            $_SESSION['login']    = true;
            $_SESSION['username'] = $data['username']; 
            $_SESSION['email']    = $data['email'];
            $_SESSION['role']     = $data['role'];

            if ($data['role'] === 'admin') {
                header("Location: admin/admin_dashboard.php");
            } else {
                header("Location: dashboard.php");
            }
            exit;
        }
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
    <link rel="stylesheet" href="assets/css/login.css">
</head>

<?php include 'components/head.php'; ?>
<body>
<video autoplay muted loop playsinline class="bg-video">
    <source src="assets/img/book2.mp4" type="video/mp4">
</video>
<div class="video-overlay"></div>

    <?php include 'components/navbar.php'; ?>

    <div class="login-box">
        <h2>Login SIPUS</h2>

        <?php if(!empty($error)): ?>
            <p class="error"><?= $error ?></p>
        <?php endif; ?>

        <form method="POST">
    <input type="email" name="email" placeholder="Email" required autocomplete="off">
    <input type="password" name="password" placeholder="Password" required autocomplete="new-password">

    <select name="role" required>
        <option value="" disabled selected>Pilih Role</option>
        <option value="admin">Admin</option>
        <option value="user">Pengguna</option>
    </select>

    <button type="submit">Login</button>
</form>

        <p style="margin-top: 10px;">
            <a href="forgot_password.php" style="color:#5a3e2b;">Lupa Password?</a>
        </p>

        <a href="register.php" class="link-daftar" style="color:#5a3e2b;">Belum punya akun? Daftar</a>
    </div>

    <?php include 'components/footer.php'; ?>
<script src="assets/js/login.js"></script>
</body>
</html>
