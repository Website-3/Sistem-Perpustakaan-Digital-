<?php
session_start();
if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'user') {
    header("Location: login.php");
    exit;
}

$pageTitle = "SIPUS – Dashboard";
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <?php include 'components/head.php'; ?>
<style>

*{box-sizing:border-box;margin:0;padding:0;font-family:'Poppins',sans-serif;}
body{
    background:#2c241f;
    color:var(--text-cream);
    padding-top:80px;
    overflow-x:hidden;
    transition:.3s;
}

.bg-video{
    position:fixed;
    top:0; left:0;
    width:100%; height:100%;
    object-fit:cover;
    z-index:-10;
    filter:brightness(50%);
}

:root{
    --coklat-d1:#3a2f29;
    --coklat-d2:#4a3a31;
    --coklat-mid:#6b5143;
    --coklat-soft:#8b6d5c;

    --emas-soft:#e6d3a3;
    --emas-bright:#f7e9c3;
    --emas-glow:rgba(247, 229, 173, 0.55);

    --text-cream:#f7efe6;
    --text-smooth:#ded8d3;

    --border-soft:rgba(255,255,255,0.12);
}

.navbar{
    position:fixed;top:0;left:0;width:100%;z-index:100;
    padding:14px 32px;
    display:flex;justify-content:space-between;align-items:center;
    background:rgba(55,42,33,0.65);
    border-bottom:1px solid var(--border-soft);
    backdrop-filter:blur(10px);
}
.nav-left{
    display:flex;align-items:center;gap:12px;
    color:var(--emas-soft);font-weight:700;font-size:22px;
}
.nav-left img{
    width:50px;height:50px;border-radius:50%;
    object-fit:cover;
    border:2px solid var(--emas-soft);
    box-shadow:0 0 12px var(--emas-glow);
}

.btn-control{
    padding:8px 14px;
    background:rgba(255,255,255,0.1);
    color:var(--text-cream);
    border:none;border-radius:10px;
    font-weight:600;cursor:pointer;
    backdrop-filter:blur(6px);
    transition:.3s;
}
.btn-control:hover{
    box-shadow:0 0 12px var(--emas-glow);
    transform:translateY(-3px);
}

.sidebar{
    position:fixed;top:0;left:0;height:100vh;width:250px;
    padding:110px 20px;
    background:rgba(60,48,38,0.55);
    border-right:1px solid var(--border-soft);
    backdrop-filter:blur(12px);
    transition:.35s;
}
.sidebar.hidden{transform:translateX(-280px);}
.sidebar ul{list-style:none;}
.sidebar ul li{margin:18px 0;}
.sidebar a{
    text-decoration:none;
    display:block;
    padding:12px 16px;
    border-radius:12px;
    font-weight:600;
    color:var(--text-cream);
    border:1px solid rgba(255,255,255,0.07);
    transition:.25s;
}
.sidebar a:hover,
.sidebar a.active{
    background:linear-gradient(90deg,var(--emas-soft),var(--emas-bright));
    color:#3a2f14;
    box-shadow:0 0 12px var(--emas-glow);
    transform:translateX(8px);
}
.content{
    margin-left:260px;
    padding:40px;
    transition:.35s;
}

.welcome-box{
    padding:25px 35px;
    background:rgba(255,255,255,0.06);
    border:1px solid var(--border-soft);
    border-radius:18px;
    backdrop-filter:blur(10px);
    box-shadow:0 6px 20px rgba(0,0,0,0.4);
}
.welcome-box h1{color:var(--emas-bright);}
.welcome-box h2{color:var(--text-cream);}

.cards{
    margin-top:30px;
    display:flex;
    gap:26px;
    flex-wrap:wrap;
}
.card{
    width:300px;
    padding:22px;
    border-radius:16px;
    background:rgba(255,255,255,0.06);
    border:1px solid var(--border-soft);
    box-shadow:0 10px 30px rgba(0,0,0,0.55);
    backdrop-filter:blur(10px);
    transition:.3s;
    text-align:center;
}
.card:hover{
    transform:translateY(-10px);
    border-color:rgba(255,230,180,0.3);
    box-shadow:0 16px 40px rgba(0,0,0,0.6);
}
.card-img{
    width:100%;height:150px;border-radius:12px;object-fit:cover;margin-bottom:15px;
}
.card h3{color:var(--emas-bright);}
.card a.btn{
    margin-top:14px;
    display:inline-block;
    padding:10px 18px;
    background:linear-gradient(90deg,var(--emas-soft),var(--emas-bright));
    color:#3d2e15;font-weight:700;text-decoration:none;border-radius:10px;
}
.card a.btn:hover{
    box-shadow:0 8px 18px var(--emas-glow);
    transform:translateY(-3px);
}

footer{
    position:fixed;bottom:0;left:0;width:100%;
    background:rgba(55,42,33,0.65); 
    padding:14px;
    color:var(--emas-bright);
    text-align:center;
    border-top:1px solid var(--border-soft);
    backdrop-filter:blur(10px);
}

body.dark-mode footer{
    background:rgba(0,0,0,0.75); 
    color:#e0e0e0;
}

body.dark-mode{
    background:#0a0a0a;
    color:#e0e0e0;
}
body.dark-mode .navbar{background:rgba(0,0,0,0.75);}
body.dark-mode .sidebar{background:rgba(0,0,0,0.5);}
body.dark-mode .card,
body.dark-mode .welcome-box{
    background:rgba(255,255,255,0.03);
}
</style>
</head>

<body>

<video autoplay loop muted class="bg-video">
    <source src="assets/img/lib.mp4" type="video/mp4">
</video>

<div class="navbar">
    <div class="nav-left">
        <img src="assets/img/logo.jpg" alt="Logo">
        SIPUS
    </div>
    <div class="nav-controls">
        <button id="toggle-theme" class="btn-control">Dark Mode</button>
        <button id="toggle-sidebar" class="btn-control">Hide Sidebar</button>
    </div>
</div>
<?php include 'components/sidebar.php'; ?>

<div class="content" id="main-content">

    <div class="welcome-box">
        <h1>Selamat datang di SIPUS</h1>
        <h2><?= $_SESSION['username']; ?></h2>
    </div>

    <div class="cards">
        <div class="card">
            <img src="assets/img/koleksi.jpg" class="card-img">
            <h3>Koleksi Buku</h3>
            <a href="koleksi.php" class="btn">Lihat</a>
        </div>

        <div class="card">
            <img src="assets/img/status.jpg" class="card-img">
            <h3>Status Buku</h3>
            <a href="status.php" class="btn">Cek Status</a>
        </div>

        <div class="card">
            <img src="assets/img/informasi.jpg" class="card-img">
            <h3>Informasi Perpustakaan</h3>
            <a href="informasi.php" class="btn">Lihat Info</a>
        </div>
    </div>
</div>

<?php include 'components/footer.php'; ?>

<script>
const themeBtn = document.getElementById("toggle-theme");

function setDark(active){
    document.body.classList.toggle("dark-mode", active);
    localStorage.setItem("sipusDarkMode", active ? "on" : "off");
    themeBtn.textContent = active ? "Light Mode" : "Dark Mode";
}

themeBtn.addEventListener("click", ()=> {
    const active = !document.body.classList.contains("dark-mode");
    setDark(active);
});

window.addEventListener("load", ()=> {
    if (localStorage.getItem("sipusDarkMode") === "on") {
        setDark(true);
    }
});

const sidebar = document.getElementById("sidebar");
const main = document.getElementById("main-content");
const toggleSidebarBtn = document.getElementById("toggle-sidebar");

toggleSidebarBtn.onclick = () => {
    sidebar.classList.toggle("hidden");
    main.style.marginLeft = sidebar.classList.contains("hidden") ? "0" : "260px";
};
</script>


</body>
</html>
