<div class="sidebar" id="sidebar">
    <ul>
        <li><a href="dashboard.php" class="<?= basename($_SERVER['PHP_SELF'])=='dashboard.php'?'active':'' ?>">Beranda</a></li>
        <li><a href="koleksi.php"   class="<?= basename($_SERVER['PHP_SELF'])=='koleksi.php'?'active':'' ?>">Koleksi Buku</a></li>
        <li><a href="status.php"    class="<?= basename($_SERVER['PHP_SELF'])=='status.php'?'active':'' ?>">Status Buku</a></li>
        <li><a href="informasi.php" class="<?= basename($_SERVER['PHP_SELF'])=='informasi.php'?'active':'' ?>">Informasi Perpustakaan</a></li>
        <li><a href="akun.php"      class="<?= basename($_SERVER['PHP_SELF'])=='akun.php'?'active':'' ?>">Akun</a></li>
        <li><a href="logout.php">Keluar</a></li>
    </ul>
</div>
