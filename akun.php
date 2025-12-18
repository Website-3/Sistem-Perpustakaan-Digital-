<?php
session_start();
require 'koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];
$q = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username'");
$user = mysqli_fetch_assoc($q);
if(!$user){ echo "User tidak ditemukan"; exit; }
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>SIPUS – Akun</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<head>
    <?php include 'components/head.php'; ?>
<style>
*{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}

:root{
--emas-soft:#e6d3a3;
--emas-bright:#f7e9c3;
--emas-glow:rgba(247,229,173,.55);
--text-cream:#f7efe6;
--border-soft:rgba(255,255,255,.12);
}

body{
background:#2c241f;
color:var(--text-cream);
padding-top:80px;
transition:.3s;
overflow-x:hidden;
}

.bg-video{
position:fixed;top:0;left:0;width:100%;height:100%;
object-fit:cover;
filter:brightness(45%);
z-index:-10;
}

.navbar{
position:fixed;top:0;left:0;width:100%;z-index:10;
display:flex;justify-content:space-between;align-items:center;
padding:14px 32px;
background:rgba(55,42,33,.65);
border-bottom:1px solid var(--border-soft);
backdrop-filter:blur(10px);
}
.nav-left{
display:flex;align-items:center;gap:12px;
font-size:22px;font-weight:700;color:var(--emas-soft);
}
.nav-left img{
width:48px;height:48px;border-radius:50%;
border:2px solid var(--emas-soft);
box-shadow:0 0 12px var(--emas-glow);
}
.btn-control{
background:rgba(255,255,255,.1);
color:var(--text-cream);
border:none;
padding:8px 14px;
border-radius:10px;
cursor:pointer;font-weight:600;
transition:.3s;
}
.btn-control:hover{
box-shadow:0 0 12px var(--emas-glow);
transform:translateY(-3px);
}

.sidebar{
position:fixed;top:0;left:0;height:100vh;width:260px;
padding:110px 22px;
background:rgba(60,48,38,.55);
border-right:1px solid var(--border-soft);
backdrop-filter:blur(12px);
transition:.35s;
}
.sidebar.hidden{transform:translateX(-280px);}
.sidebar ul{list-style:none;}
.sidebar li{margin:18px 0;}
.sidebar a{
display:block;
padding:12px 16px;
border-radius:12px;
text-decoration:none;
color:var(--text-cream);
font-weight:600;
border:1px solid rgba(255,255,255,.07);
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

.account-card{
max-width:520px;
margin:auto;
padding:28px;
border-radius:20px;
background:rgba(255,255,255,.06);
border:1px solid var(--border-soft);
backdrop-filter:blur(12px);
box-shadow:0 20px 40px rgba(0,0,0,.55);
text-align:center;
}
.account-card h2{
color:var(--emas-bright);
margin-bottom:18px;
}
.profile{
width:130px;height:130px;
border-radius:50%;
border:3px solid var(--emas-soft);
object-fit:cover;
box-shadow:0 0 20px var(--emas-glow);
margin-bottom:15px;
}
.info{
text-align:left;
margin-top:20px;
}
.info div{
margin-bottom:10px;
font-size:15px;
}
.info span{color:var(--emas-soft);font-weight:600;}

.btn{
width:100%;
margin-top:16px;
padding:10px;
border:none;
border-radius:12px;
background:linear-gradient(90deg,var(--emas-soft),var(--emas-bright));
font-weight:700;
cursor:pointer;
}
.btn:hover{
box-shadow:0 8px 18px var(--emas-glow);
transform:translateY(-3px);
}

#editForm{display:none;margin-top:20px;}
#editForm input{
width:100%;
padding:10px;
margin-bottom:12px;
border-radius:8px;
border:none;
}

body.dark-mode{
background:#080808;
color:#e0e0e0;
}
body.dark-mode .navbar,
body.dark-mode footer{
background:rgba(0,0,0,.75);
}

footer{
position:fixed;bottom:0;left:0;width:100%;
background:rgba(55,42,33,.65);
color:var(--emas-bright);
padding:14px;
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

<video class="bg-video" autoplay muted loop>
<source src="assets/img/lib.mp4" type="video/mp4">
</video>

<div class="navbar">
<div class="nav-left">
<img src="assets/img/logo.jpg"> SIPUS
</div>
<div>
<button id="darkBtn" class="btn-control">Dark Mode</button>
<button id="sideBtn" class="btn-control">Sidebar</button>
</div>
</div>


<?php include 'components/sidebar.php'; ?>

<div class="content" id="content">
<div class="account-card">
<img src="assets/img/admin.jpg" class="profile">
<h2><?= htmlspecialchars($user['username']); ?></h2>

<div class="info">
<div><span>Username :</span> <?= $user['username']; ?></div>
<div><span>Email :</span> <?= $user['email']; ?></div>
<div><span>Role :</span> <?= $user['role']; ?></div>
</div>

<button class="btn" id="editBtn">Edit Akun</button>

<div id="editForm">
<form method="POST" action="update_account.php">
<input type="hidden" name="id" value="<?= $user['id']; ?>">
<input type="text" name="username" value="<?= $user['username']; ?>" required>
<input type="email" name="email" value="<?= $user['email']; ?>">
<input type="password" name="password" placeholder="Password baru (opsional)">
<button class="btn">Simpan</button>
</form>
</div>
</div>
</div>


<?php include 'components/footer.php'; ?>

<script>

const sidebar = document.getElementById("sidebar");
const content = document.getElementById("content");
const sideBtn = document.getElementById("sideBtn");

sideBtn.onclick = () => {
    sidebar.classList.toggle("hidden");
    content.style.marginLeft = sidebar.classList.contains("hidden") ? "0" : "260px";
    localStorage.setItem("sipusSidebar", sidebar.classList.contains("hidden") ? "hide" : "show");
};

window.onload = () => {
    if (localStorage.getItem("sipusSidebar") === "hide") {
        sidebar.classList.add("hidden");
        content.style.marginLeft = "0";
    }
};

const darkBtn = document.getElementById("darkBtn");

function setDarkMode(active){
    document.body.classList.toggle("dark-mode", active);
    localStorage.setItem("sipusDark", active ? "on" : "off");
    darkBtn.textContent = active ? "Light Mode" : "Dark Mode";
}

darkBtn.onclick = () => {
    const active = !document.body.classList.contains("dark-mode");
    setDarkMode(active);
};

if(localStorage.getItem("sipusDark") === "on"){
    setDarkMode(true);
}
document.getElementById("editBtn").onclick = () => {
    const f = document.getElementById("editForm");
    f.style.display = f.style.display === "block" ? "none" : "block";
};
</script>


</body>
</html>
