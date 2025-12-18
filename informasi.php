<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Informasi Perpustakaan - SIPUS</title>


<head>
    <?php include 'components/head.php'; ?>

<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif}
html,body{height:100%}
body{
    padding-top:80px;
    background:#2c241f;
    color:#f2e9df;
    transition:.3s;
}

.bg-video{
    position:fixed;
    top:0;left:0;
    width:100%;
    height:100%;
    object-fit:cover;
    filter:brightness(45%);
    z-index:-10;
}

:root{
    --emas:#f7e9c3;
    --gold-glow:rgba(247,229,173,.5);
    --border:rgba(255,255,255,.12);
}

.navbar{
    position:fixed;top:0;left:0;width:100%;
    padding:14px 32px;
    display:flex;justify-content:space-between;align-items:center;
    background:rgba(55,42,33,.65);
    backdrop-filter:blur(10px);
    border-bottom:1px solid var(--border);
    z-index:100;
}
.nav-left{
    display:flex;align-items:center;gap:12px;
    font-size:22px;font-weight:700;color:var(--emas);
}
.logo{
    width:48px;height:48px;border-radius:50%;
    object-fit:cover;
    border:2px solid #d4b07c;
    box-shadow:0 0 12px rgba(212,176,124,.8);
}
.btn-control{
    padding:8px 14px;
    border:none;border-radius:10px;
    background:rgba(255,255,255,.1);
    color:#fff;font-weight:600;
    cursor:pointer;
}
.btn-control:hover{box-shadow:0 0 12px var(--gold-glow)}

.sidebar{
    position:fixed;top:0;left:0;width:250px;height:100vh;
    padding:110px 22px;
    background:rgba(60,48,38,.55);
    backdrop-filter:blur(12px);
    transition:.3s;
    z-index:90;
}
.sidebar.hidden{transform:translateX(-280px);}
.sidebar ul{list-style:none}
.sidebar li{margin:18px 0}
.sidebar a{
    display:block;
    padding:12px 16px;
    border-radius:12px;
    text-decoration:none;
    font-weight:600;
    color:#f7efe6;
    border:1px solid rgba(255,255,255,.07);
}
.sidebar a:hover,
.sidebar a.active{
    background:linear-gradient(90deg,#e6d3a3,#f3e5be);
    color:#3a2f14;
    box-shadow:0 0 12px var(--gold-glow);
}

.main{
    margin-left:260px;
    padding:120px 36px;
    transition:.3s;
}

.topbar,.header-card,.card{
    background:rgba(42,31,20,.9);
    border:1px solid var(--gold-glow);
    box-shadow:0 0 18px var(--gold-glow);
    border-radius:16px;
}
.topbar{padding:20px}
.title{font-size:22px;font-weight:700;color:var(--emas)}
.sub{margin-top:6px;color:#ded8d3}

.header-card{margin-top:28px;padding:25px}
.header-card h2{color:var(--emas)}
.header-card p{margin-top:10px;line-height:1.8}

.cards{
    display:flex;flex-wrap:wrap;
    gap:26px;margin-top:26px;
}
.card{
    flex:1 1 22%;
    min-width:250px;
    padding:22px;
}
.card h3{color:var(--emas)}
.card p{margin-top:10px;line-height:1.6}
.card .btn{
    display:inline-block;margin-top:14px;
    padding:10px 18px;
    background:linear-gradient(90deg,#e6d3a3,#f3e5be);
    color:#3d2e15;
    font-weight:700;
    border-radius:10px;
    text-decoration:none;
}

footer{
    background:rgba(0,0,0,.5);
    padding:20px;
    text-align:center;
    color:var(--emas);
}

body.dark-mode{background:#000}
body.dark-mode .navbar,
body.dark-mode .sidebar{background:rgba(0,0,0,.75)}
body.dark-mode .bg-video{filter:brightness(30%)}
body.dark-mode .topbar,
body.dark-mode .header-card,
body.dark-mode .card{background:#111}
</style>
</head>

<body>

<video class="bg-video" autoplay muted loop playsinline>
  <source src="assets/img/lib.mp4" type="video/mp4">
</video>

<div class="navbar">
  <div class="nav-left">
    <img src="assets/img/logo.jpg" class="logo">
    SIPUS
  </div>
  <div>
    <button id="toggle-theme" class="btn-control">Dark Mode</button>
    <button id="toggle-sidebar" class="btn-control">Hide Sidebar</button>
  </div>
</div>

<?php include 'components/sidebar.php'; ?>

<main class="main" id="main">

<div class="topbar">
  <div class="title">Informasi Perpustakaan</div>
  <div class="sub">Halaman informasi & layanan perpustakaan</div>
</div>

<section class="header-card">
  <h2>Sejarah Perpustakaan Universitas Lampung</h2>
  <p>
    Perpustakaan Universitas Lampung (UNILA) berdiri bersamaan dengan pendirian universitas
    pada tahun 1965. Pada masa awal, perpustakaan masih berupa layanan sederhana yang
    menempati ruangan kecil dan hanya memiliki koleksi terbatas berupa buku-buku dasar
    untuk mendukung kegiatan belajar mengajar pada beberapa fakultas awal. Seiring
    berkembangnya program studi dan meningkatnya kebutuhan akademik, perpustakaan mulai
    melakukan penambahan koleksi, penyusunan katalog manual, serta penyediaan layanan
    referensi untuk mahasiswa dan dosen.
  </p>
  <p class="muted">
    User: <strong><?= htmlspecialchars($_SESSION['username'] ?? 'Pengguna') ?></strong>
  </p>
</section>

<section class="cards">
  <article class="card">
    <h3>Profil Singkat</h3>
    <p>
      Perpustakaan SIPUS menyediakan koleksi buku cetak & digital, ruang baca nyaman,
      layanan referensi, serta dukungan literasi informasi bagi seluruh sivitas akademika.
    </p>

  </article>

  <article class="card">
    <h3>Jam Operasional</h3>
    <p>
      Senin–Jumat: 08.00 – 16.00<br>
      Sabtu: 09.00 – 12.00<br>
      Minggu & Libur Nasional: Tutup
    </p>
  </article>

  <article class="card">
    <h3>Tata Tertib</h3>
    <p>
      • Menjaga ketenangan ruang baca.<br>
      • Menjaga kebersihan dan merapikan kursi.<br>
      • Mengembalikan buku tepat waktu.<br>
      • Dilarang makan berat dan merusak fasilitas.
    </p>
  </article>

  <article class="card">
    <h3>Layanan & Fasilitas</h3>
    <p>
      - Peminjaman & Pengembalian<br>
      - WiFi Gratis<br>
      - Akses Jurnal Online<br>
      - Komputer Riset & Ruang Diskusi<br>
      - Konsultasi Literasi Digital
    </p>
  </article>
</section>

</main>

<?php include 'components/footer.php'; ?>

<script>
const sidebar = document.getElementById("sidebar");
const main = document.getElementById("main");
const themeBtn = document.getElementById("toggle-theme");
const sideBtn = document.getElementById("toggle-sidebar");

sideBtn.onclick = () => {
  sidebar.classList.toggle("hidden");
  main.style.marginLeft = sidebar.classList.contains("hidden") ? "0" : "260px";
};

function setDark(on){
  document.body.classList.toggle("dark-mode", on);
  localStorage.setItem("sipusDark", on ? "on" : "off");
  themeBtn.innerText = on ? "Light Mode" : "Dark Mode";
}

themeBtn.onclick = () => {
  setDark(!document.body.classList.contains("dark-mode"));
};

window.onload = () => {
  if(localStorage.getItem("sipusDark") === "on"){
    setDark(true);
  }
};
</script>

</body>
</html>
