<?php
session_start();

require 'koneksi.php';

$result = mysqli_query($koneksi, "SELECT id, judul, penulis, img FROM buku");

$serverBooks = [];
while($row = mysqli_fetch_assoc($result)){
    $serverBooks[] = $row;
}


$pageTitle = "Koleksi Buku – SIPUS";
?>
<!DOCTYPE html>
<html lang="id">

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
    z-index:-10;
    pointer-events:none;
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
    padding:0 30px;
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
    margin-left:-30px;
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
    margin:25px auto;
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
.top-bar input,
.top-bar select{
    width:240px;
    padding:12px 16px;
    border-radius:12px;
    background:#fff;
    border:2px solid var(--emas-soft);
}

.book-grid{
    display:grid;
    grid-template-columns:repeat(auto-fill,minmax(190px,1fr));
    gap:22px;
}
.book-item{
    background:linear-gradient(145deg,#f6ebc9,#ecd9a6);
    border-radius:18px;
    padding:16px;
    border:1px solid rgba(180,140,60,.35);
    color:#3a2f14;
    cursor:pointer;
    animation:fadeUp .6s ease forwards;
    box-shadow:
        0 10px 25px rgba(0,0,0,.25),
        inset 0 1px 0 rgba(255,255,255,.6);
    transition:.35s cubic-bezier(.2,.8,.2,1);
}
.book-item:hover{
    transform:translateY(-10px) scale(1.03);
    box-shadow:
        0 20px 45px rgba(0,0,0,.35),
        0 0 25px rgba(247,229,173,.55);
}
.book-item img{
    width:100%;
    height:165px;
    object-fit:cover;
    pointer-events:none;
    border-radius:14px;
    margin-bottom:14px;
    box-shadow:0 6px 15px rgba(0,0,0,.35);
}

.book-item h3{
    font-size:15px;
    font-weight:700;
    margin-bottom:4px;
}

.book-item p{
    font-size:13px;
    opacity:.85;
}
@keyframes fadeUp {
    from {
        opacity:0;
        transform:translateY(25px) scale(.97);
    }
    to {
        opacity:1;
        transform:translateY(0) scale(1);
    }
}

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

body.dark-mode .book-item{
    background:linear-gradient(145deg,#1c1c1c,#2a2a2a);
    color:#f5f5f5;
    border:1px solid rgba(255,215,150,.25);
    box-shadow:
        0 12px 30px rgba(0,0,0,.7),
        inset 0 1px 0 rgba(255,255,255,.06);
}

body.dark-mode .book-item h3{
    color:#f7e9c3;
}

body.dark-mode .book-item p{
    color:#cfcfcf;
}

body.dark-mode .book-item:hover{
    box-shadow:
        0 22px 55px rgba(0,0,0,.85),
        0 0 20px rgba(247,229,173,.25);
}

.book-item{
    position:relative;
    overflow:hidden;
}

.book-item:active{
    transform:scale(.96);
}

.book-item::after{
    content:"";
    position:absolute;
    inset:0;
    border-radius:18px;
    background:radial-gradient(circle at center,
        rgba(247,229,173,.55),
        transparent 60%);
    opacity:0;
    transition:.35s;
}

.book-item.tuing::after{
    opacity:1;
    animation:tuingGlow .45s ease-out;
}

@keyframes tuingGlow{
    0%{
        transform:scale(.3);
        opacity:.9;
    }
    100%{
        transform:scale(1.4);
        opacity:0;
    }
}
.book-item.tuing {
    animation:none !important;
}
body, html {
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
    <h2>Koleksi Buku</h2>

    <div class="top-bar">
        <input id="search-book" placeholder="Cari buku...">
        <select id="sort-book">
            <option value="">Urutkan</option>
            <option value="az">A - Z</option>
            <option value="za">Z - A</option>
        </select>
    </div>

    <div id="book-container" class="book-grid"></div>
</div>

<?php include 'components/footer.php'; ?>


<script>
document.addEventListener("DOMContentLoaded", () => {

    const books = <?= json_encode($serverBooks ?? []); ?>;

    const sidebar = document.getElementById("sidebar");
    const main = document.getElementById("main-content");
    const toggleSidebarBtn = document.getElementById("toggle-sidebar-btn");
    const darkBtn = document.getElementById("dark-mode-btn");

    const box = document.getElementById("book-container");
    const search = document.getElementById("search-book");
    const sort = document.getElementById("sort-book");

    function setDarkMode(active){
        document.body.classList.toggle("dark-mode", active);
        localStorage.setItem("sipusDark", active ? "on" : "off");
        darkBtn.innerText = active ? "Light Mode" : "Dark Mode";
    }

    darkBtn.addEventListener("click", () => {
        setDarkMode(!document.body.classList.contains("dark-mode"));
    });

    if(localStorage.getItem("sipusDark") === "on"){
        setDarkMode(true);
    }

    toggleSidebarBtn.addEventListener("click", () => {
        sidebar.classList.toggle("hidden");
        main.style.marginLeft = sidebar.classList.contains("hidden") ? "0" : "220px";
    });

    function render(list){
        box.innerHTML = "";
        list.forEach(b => {
            const d = document.createElement("div");
            d.className = "book-item";
            d.innerHTML = `
    <img src="assets/img/${b.img}">
    <h3>${b.judul}</h3>
    <p>${b.penulis}</p>
`;
d.addEventListener("click", (e) => {
    e.preventDefault();

    d.classList.remove("tuing");
    void d.offsetWidth;
    d.classList.add("tuing");

    setTimeout(() => {
        window.location.href = "detail.php?id=" + b.id;
    }, 420);
});


            box.appendChild(d);
        });
    }

    render(books); 
    search.addEventListener("input", () => {
        const q = search.value.toLowerCase().trim();
        if(!q){ render(books); return; }
        render(books.filter(b =>
            b.judul.toLowerCase().includes(q) ||
            b.penulis.toLowerCase().includes(q)
        ));
    });

    sort.addEventListener("change", () => {
        let sorted = [...books];
        if(sort.value === "az") sorted.sort((a,b)=>a.judul.localeCompare(b.judul));
        if(sort.value === "za") sorted.sort((a,b)=>b.judul.localeCompare(a.judul));
        render(sorted);
    });

});
</script>


</body>
</html>
