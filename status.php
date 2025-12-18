<?php
require 'koneksi.php';

$q = mysqli_query($koneksi, "SELECT * FROM buku ORDER BY id ASC");
$serverBooks = [];
while ($row = mysqli_fetch_assoc($q)) {
    $serverBooks[] = $row;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Status Buku – SIPUS</title>
<head>
    <?php include 'components/head.php'; ?>
<style>

:root{
    --emas-soft:#e6d3a3;
    --emas-bright:#f7e9c3;
    --emas-glow:rgba(247,229,173,.55);
    --text-cream:#f7efe6;
    --border-soft:rgba(255,255,255,.12);
}

*{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}

body{
    padding-top:80px;
    background:#2c241f;
    color:var(--text-cream);
    overflow-x:hidden;
}

.bg-video{
    position:fixed;
    inset:0;
    width:100%;
    height:100%;
    object-fit:cover;
    z-index:-2;
    filter:brightness(45%);
}

.navbar{
    position:fixed;
    top:0;left:0;width:100%;
    padding:14px 0;
    background:rgba(55,42,33,.65);
    backdrop-filter:blur(10px);
    border-bottom:1px solid var(--border-soft);
    z-index:100;
}
.nav-container{
    max-width:1450px;
    margin:auto;
    padding:0 -10px;
    display:flex;
    justify-content:space-between;
    align-items:center;
}
.nav-left{
    display:flex;
    align-items:center;
    gap:14px;
    font-size:22px;
    font-weight:700;
    color:var(--emas-soft);
}
.nav-left img{
    width:50px;height:50px;
    border-radius:50%;
    object-fit:cover;
    border:2px solid var(--emas-soft);
    box-shadow:0 0 12px var(--emas-glow);
}
.nav-controls{display:flex;gap:10px;}
.btn-control{
    padding:8px 14px;
    border:none;
    border-radius:10px;
    background:rgba(255,255,255,.12);
    color:var(--text-cream);
    font-weight:600;
    cursor:pointer;
    transition:.3s;
}
.btn-control:hover{
    transform:translateY(-2px);
    box-shadow:0 0 12px var(--emas-glow);
}

.sidebar{
    position:fixed;
    top:0;left:0;
    width:220px;height:100vh;
    padding:100px 20px 20px;
    background:rgba(60,48,38,.55);
    backdrop-filter:blur(12px);
    border-right:1px solid var(--border-soft);
    transition:.3s;
}
.sidebar.hidden{transform:translateX(-240px);}
.sidebar ul{list-style:none;}
.sidebar li{margin:18px 0;}
.sidebar a{
    text-decoration:none;
    color:var(--text-cream);
    font-weight:600;
    padding:10px 15px;
    border-radius:12px;
    display:block;
    border:1px solid rgba(255,255,255,.06);
    transition:.25s;
}
.sidebar a:hover,
.sidebar a.active{
    background:linear-gradient(90deg,var(--emas-soft),var(--emas-bright));
    color:#3a2f14;
    box-shadow:0 0 12px var(--emas-glow);
}

.main-content{
    margin-left:220px;
    padding:30px;
    transition:.3s;
}
h2{
    margin:20px auto;
    width:fit-content;
    padding:12px 26px;
    border-radius:14px;
    background:rgba(255,255,255,.08);
    backdrop-filter:blur(8px);
    border:1px solid var(--border-soft);
    color:var(--emas-bright);
}

.top-bar{
    display:flex;
    justify-content:center;
    gap:14px;
    margin:20px 0 30px;
}
.top-bar input{
    width:260px;
    padding:12px 16px;
    border-radius:12px;
    background:#fff;
    border:2px solid var(--emas-soft);
}

#status-container{
    display:grid;
    grid-template-columns:repeat(auto-fill, minmax(220px,1fr));
    gap:24px;
}

.card{
    background:linear-gradient(145deg,#f6ebc9,#ecd9a6);
    border-radius:18px;
    padding:18px;
    border:1px solid rgba(180,140,60,.35);
    color:#3a2f14;
    box-shadow:
        0 10px 25px rgba(0,0,0,.25),
        inset 0 1px 0 rgba(255,255,255,.6);
    transition:.35s cubic-bezier(.2,.8,.2,1);
}
.card:hover{
    transform:translateY(-10px) scale(1.03);
    box-shadow:
        0 20px 45px rgba(0,0,0,.35),
        0 0 25px rgba(247,229,173,.55);
}
.judul{font-size:17px;font-weight:700;margin-bottom:6px;}
.info{font-size:13px;opacity:.85;margin:2px 0;}

.status-box{
    margin-top:10px;
    padding:8px 10px;
    border-radius:8px;
    font-weight:700;
    display:inline-block;
    font-size:13px;
}
.dipinjam{background:#b2541a;color:white;}
.tersedia{background:#6d4b28;color:white;}

footer{
    margin-top:40px;
    padding:14px;
    text-align:center;
    background:rgba(55,42,33,.65);
}

body.dark-mode{
    background:#0b0b0b;
    color:#f5f5f5;
}
body.dark-mode .bg-video{filter:brightness(20%);}
body.dark-mode .navbar,
body.dark-mode footer{
    background:rgba(0,0,0,.75);
}
body.dark-mode .sidebar{
    background:rgba(0,0,0,.6);
}
body.dark-mode .card{
    background:linear-gradient(145deg,#1c1c1c,#2a2a2a);
    color:#f5f5f5;
    border:1px solid rgba(255,215,150,.25);
}
body.dark-mode .dipinjam{background:#a13e05;}
body.dark-mode .tersedia{background:#4d3a1f;}
html, body {
    height: 100%;
}

.main-content {
    min-height: calc(100vh - 150px);
}

</style>
</head>

<body>

<video class="bg-video" autoplay muted loop>
    <source src="assets/img/cari.mp4" type="video/mp4">
</video>

<div class="navbar">
    <div class="nav-container">
        <div class="nav-left">
            <img src="assets/img/logo.jpg"> SIPUS
        </div>
        <div class="nav-controls">
            <button id="dark-mode-btn" class="btn-control">Dark Mode</button>
            <button id="toggle-sidebar-btn" class="btn-control">Hide Sidebar</button>
        </div>
    </div>
</div>

<?php include 'components/sidebar.php'; ?>

<div class="main-content" id="main-content">

<h2>Status Buku</h2>

<div class="top-bar">
    <input id="search-book" placeholder="Cari buku...">
</div>

<div id="status-container"></div>

</div>

<?php include 'components/footer.php'; ?>


<script>
const books = <?= json_encode($serverBooks); ?>;
const box = document.getElementById("status-container");
const search = document.getElementById("search-book");

function render(list){
    box.innerHTML="";
    list.forEach(b=>{
        const d=document.createElement("div");
        d.className="card";
        d.innerHTML=`
            <div class="judul">${b.judul}</div>
            <div class="info">Penulis: ${b.penulis}</div>
            <div class="info">Tahun: ${b.tahun}</div>
            ${b.status === "dipinjam"
                ? `<div class="status-box dipinjam">Dipinjam</div>
                   <div class="info"><b>Kembali:</b> ${b.tanggal_kembali ?? "-"}</div>`
                : `<div class="status-box tersedia">Tersedia</div>`
            }
        `;
        box.appendChild(d);
    });
}

search.addEventListener("input", function(){
    const q = this.value.toLowerCase();
    const filtered = books.filter(b =>
        b.judul.toLowerCase().includes(q) ||
        b.penulis.toLowerCase().includes(q)
    );
    render(filtered);
});

const darkBtn = document.getElementById("dark-mode-btn");

function setDarkMode(active){
    document.body.classList.toggle("dark-mode", active);
    localStorage.setItem("sipusDark", active ? "on" : "off");
    darkBtn.textContent = active ? "Light Mode" : "Dark Mode";
}

darkBtn.onclick = () => {
    const active = !document.body.classList.contains("dark-mode");
    setDarkMode(active);
};

window.onload = () => {
    if(localStorage.getItem("sipusDark") === "on"){
        setDarkMode(true);
    }
};

const sidebar = document.getElementById("sidebar");
const main = document.getElementById("main-content");
const btnHide = document.getElementById("toggle-sidebar-btn");

btnHide.onclick = () => {
    sidebar.classList.toggle("hidden");
    main.style.marginLeft = sidebar.classList.contains("hidden") ? "0" : "220px";
};
</script>


</body>
</html>
