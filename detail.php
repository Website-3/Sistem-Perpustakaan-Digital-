<?php
include 'koneksi.php';

$id = $_GET['id'];

$buku = mysqli_fetch_assoc(
    mysqli_query($koneksi, "SELECT * FROM buku WHERE id='$id'")
);

$detail = mysqli_fetch_assoc(
    mysqli_query($koneksi, "SELECT * FROM detail_buku WHERE id='$id'")
);

if (!$buku || !$detail) {
    echo "Data buku tidak ditemukan!";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title><?= $buku['judul']; ?></title>

<style>
:root{
    --emas-soft:#e6d3a3;
    --emas-bright:#f7e9c3;
    --emas-glow:rgba(247,229,173,.55);
    --dark-bg:#2c241f;
    --dark-panel:#3a2f29;
    --text-dark:#3a2f29;
}
.content{
    display:flex;
    justify-content:center;
    margin-left:220px;
    padding:30px;
}

body.dark-mode{
    background:#0f0f0f;
    color:#eee;
}

body.dark-mode .navbar,
body.dark-mode footer{
    background:rgba(0,0,0,.75);
    border-color:rgba(255,255,255,.08);
}

body.dark-mode .container{
    background:linear-gradient(145deg,#2b2b2b,#1c1c1c);
    color:#eee;
}

body.dark-mode .detail-box{
    background:#1e1e1e;
    border-left-color:#c89f75;
    color:#eee;
}

body.dark-mode .back{
    background:linear-gradient(90deg,#c89f75,#e6c38c);
    color:#2b1c0f;
}

body {
    font-family: 'Poppins', Arial, sans-serif;
    margin: 0;
    padding-top: 80px;
    background: #2c241f;
    color: #f7efe6;
}

.navbar {
    width: 100%;
    background: rgba(55,42,33,.75);
    backdrop-filter: blur(10px);
    color: var(--emas-bright);
    position: fixed;
    top: 0;
    left: 0;
    padding: 14px 0;
    z-index: 1000;
    border-bottom: 1px solid rgba(255,255,255,.1);
}
.nav-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 25px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.nav-left {
    display: flex;
    align-items: center;
    gap: 12px;
    font-size: 26px;
    font-weight: 700;
}
.nav-left img {
    width: 42px;
    height: 42px;
    border-radius: 50%;
    object-fit: cover;
    border: 2px solid var(--emas-soft);
    box-shadow: 0 0 12px var(--emas-glow);
}
.btn-control{
    padding:8px 14px;
    border:none;
    border-radius:10px;
    background:rgba(255,255,255,.85);
    font-weight:600;
    cursor:pointer;
}

.content{
    margin-left:0;
    padding:40px 20px;
    min-height:calc(100vh - 140px);
    display:flex;
    justify-content:center;
    align-items:flex-start;
}
.container{
    width:100%;
    max-width:720px;
    margin:50px auto;
    padding:58px 62px;

    background:
        linear-gradient(
            135deg,
            rgba(255,245,215,0.96),
            rgba(231,208,158,0.97)
        );

    border-radius:26px;

    box-shadow:
        0 25px 60px rgba(0,0,0,0.35),
        0 0 35px rgba(247,229,173,0.45),
        inset 0 0 0 1px rgba(255,255,255,0.5);

    backdrop-filter: blur(8px);
    position:relative;

    animation: cardIn 0.9s ease-out forwards;
}
.container::after{
    content:"";
    position:absolute;
    inset:-2px;
    border-radius:26px;
    box-shadow:0 0 28px rgba(247,229,173,.55);
    pointer-events:none;
}

.container h2{
    text-align:center;
    margin-bottom:28px;
    color:#4b3524;
    font-size:26px;
    font-weight:700;
    letter-spacing:0.3px;
    text-shadow:0 2px 6px rgba(0,0,0,.15);
}

.book-cover {
    width: 210px;
    height: 230px;
    object-fit: cover;
    display: block;
    margin: 10px auto 22px auto;
    border-radius: 14px;
    box-shadow: 0 8px 20px rgba(0,0,0,.3);
}

.detail-box{
    background:rgba(255,255,255,0.88);
    padding:15px 20px;
    border-left:5px solid #d1ab6e;
    border-radius:14px;
    margin-bottom:14px;
    color:#3a2f29;
    box-shadow:0 6px 14px rgba(0,0,0,.08);
}
.detail-box label {
    font-weight: 700;
    margin-right: 6px;
}

.back {
    display: inline-block;
    margin-top: 25px;
    padding: 13px 24px;
    background: linear-gradient(90deg,#c89f75,#e6c38c);
    color: #3a2f14;
    border-radius: 12px;
    text-decoration: none;
    font-weight: 700;
    transition: .3s;
}
.back:hover {
    transform: translateY(-2px);
    box-shadow: 0 0 15px var(--emas-glow);
}

footer {
    position: fixed;
    bottom: 0;
    width: 100%;
    background: rgba(55,42,33,.75);
    backdrop-filter: blur(10px);
    color: var(--emas-bright);
    text-align: center;
    padding: 12px 0;
    border-top: 1px solid rgba(255,255,255,.1);
}
@keyframes cardIn{
    from{
        opacity:0;
        transform:translateY(30px) scale(.96);
    }
    to{
        opacity:1;
        transform:translateY(0) scale(1);
    }
}
</style>
</head>

<body>

<div class="navbar">
    <div class="nav-container">
        <div class="nav-left">
            <img src="img/logo.jpg"> SIPUS
        </div>
        <button id="darkBtn" class="btn-control">Dark Mode</button>
    </div>
</div>

<div class="content">
<div class="container">

    <h2><?= $buku['judul']; ?></h2>

    <img src="assets/img/<?= $buku['img']; ?>" class="book-cover">

    <div class="detail-box"><label>Penulis:</label><?= $buku['penulis']; ?></div>
    <div class="detail-box"><label>Penerbit:</label><?= $detail['penerbit']; ?></div>
    <div class="detail-box"><label>Tahun:</label><?= $detail['tahun']; ?></div>
    <div class="detail-box"><label>Kota:</label><?= $detail['kota']; ?></div>
    <div class="detail-box"><label>Jumlah Halaman:</label><?= $detail['jumlah_halaman']; ?></div>
    <div class="detail-box"><label>Edisi:</label><?= $detail['edisi']; ?></div>
    <div class="detail-box"><label>Cetakan:</label><?= $detail['cetakan']; ?></div>
    <div class="detail-box"><label>Jenis:</label><?= $detail['jenis']; ?></div>

    <a href="koleksi.php" class="back">← Kembali</a>

</div>
</div>

<?php include 'components/footer.php'; ?>
<script>
document.getElementById("darkBtn").onclick = () => {
    document.body.classList.toggle("dark-mode");
};
</script>
</body>
</html>
