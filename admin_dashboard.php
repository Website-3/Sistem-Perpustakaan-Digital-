<?php
session_start();
require "../koneksi.php";

if (!isset($_SESSION['login']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../login.php");
    exit;
}

if (isset($_POST['save'])) {

    $id        = $_POST['id'] ?? "";
    $judul     = $_POST['judul'];
    $penulis   = $_POST['penulis'];
    $tahun     = $_POST['tahun'];
    $status    = $_POST['status'];
    $tglKembali = $_POST['tanggal_kembali'] ?? NULL;

    if ($status == "tersedia") {
        $tglKembali = NULL; 
    }

    $penerbit = $_POST['penerbit'];
    $kota = $_POST['kota'];
    $halaman = $_POST['jumlah_halaman'];
    $edisi = $_POST['edisi'];
    $cetakan = $_POST['cetakan'];
    $jenis = $_POST['jenis'];

    $imgName = $_FILES['img']['name'];
    $tmp = $_FILES['img']['tmp_name'];
    $newName = "";

    if (!empty($imgName)) {
        $ext = pathinfo($imgName, PATHINFO_EXTENSION);
        $newName = time() . "_" . rand(100,999) . "." . $ext;
        move_uploaded_file($tmp, "../assets/img/" . $newName);

    }

    if ($id == "") {

        if ($newName == "") $newName = "default.jpg";

        mysqli_query($koneksi,
            "INSERT INTO buku (judul,penulis,tahun,img,status,tanggal_kembali)
            VALUES ('$judul','$penulis','$tahun','$newName','$status','$tglKembali')"
        );

        $last_id = mysqli_insert_id($koneksi);

        mysqli_query($koneksi,
            "INSERT INTO detail_buku 
            (id,judul,penulis,tahun,penerbit,kota,jumlah_halaman,edisi,cetakan,jenis,img)
            VALUES
            ($last_id,'$judul','$penulis','$tahun','$penerbit','$kota',
                '$halaman','$edisi','$cetakan','$jenis','$newName')"
        );

        header("Location: admin_dashboard.php?ok=tambah");
        exit;
    }

    else {

        if ($newName != "") {
            $old = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT img FROM buku WHERE id=$id"));
            if ($old && $old['img'] != "default.jpg" && file_exists("../assets/img/".$old['img'])) {
    unlink("../assets/img/".$old['img']);
}

            
            $imgQuery = ", img='$newName'";
        } else {
            $imgQuery = "";
        }

        mysqli_query($koneksi,
            "UPDATE buku SET
                judul='$judul',
                penulis='$penulis',
                tahun='$tahun',
                status='$status',
                tanggal_kembali=" . ($tglKembali ? "'$tglKembali'" : "NULL") . "
                $imgQuery
            WHERE id=$id"
        );

        mysqli_query($koneksi,
            "UPDATE detail_buku SET
                judul='$judul',
                penulis='$penulis',
                tahun='$tahun',
                penerbit='$penerbit',
                kota='$kota',
                jumlah_halaman='$halaman',
                edisi='$edisi',
                cetakan='$cetakan',
                jenis='$jenis'
                $imgQuery
            WHERE id=$id"
        );

        header("Location: admin_dashboard.php?ok=edit");
        exit;
    }
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];

    $d = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT img FROM buku WHERE id=$id"));
    if ($d && $d['img'] != "default.jpg" && file_exists("../assets/img/" . $d['img'])) {
        unlink("../assets/img/" . $d['img']);
    }

    mysqli_query($koneksi, "DELETE FROM buku WHERE id=$id");
    mysqli_query($koneksi, "DELETE FROM detail_buku WHERE id=$id");

    header("Location: admin_dashboard.php?ok=hapus");
    exit;
}

$buku = mysqli_query($koneksi,
    "SELECT b.*, d.penerbit
     FROM buku b LEFT JOIN detail_buku d ON d.id=b.id
     ORDER BY b.id DESC"
);

$edit = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $edit = mysqli_fetch_assoc(mysqli_query(
        $koneksi,
        "SELECT * FROM buku 
         JOIN detail_buku ON detail_buku.id = buku.id
         WHERE buku.id=$id"
    ));
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <?php include '../components/head.php'; ?>
<style>

:root{
    --emas:#f5d388;
    --emas2:#f0c46c;
    --glow:rgba(255,215,140,.55);
    --cream:#fff5e7;
}
*{margin:0;padding:0;box-sizing:border-box;font-family:'Poppins',sans-serif;}
body{background:#1e1a15;color:var(--cream);padding:120px 30px;}

.navbar{
    position:fixed;top:0;left:0;width:100%;
    padding:16px 32px;background:rgba(0,0,0,.35);backdrop-filter:blur(14px);
    border-bottom:1px solid rgba(255,255,255,.1);
    display:flex;justify-content:space-between;align-items:center;
    z-index:999;
}
.navbar span{font-size:24px;font-weight:700;color:var(--emas);text-shadow:0 0 12px var(--glow);}
.navbar a{color:var(--cream);font-weight:600;text-decoration:none;}

.card{
    max-width:1100px;margin:auto;background:rgba(255,255,255,.08);
    backdrop-filter:blur(10px);border-radius:22px;padding:35px;
    box-shadow:0 15px 40px rgba(0,0,0,.45);animation:fade .6s;
}

form{
    display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:28px;
}
form input, form select{
    padding:12px;border-radius:12px;border:none;
    background:rgba(255,255,255,.2);color:#fff;
}
form button{
    grid-column:span 2;padding:12px;border-radius:14px;
    background:linear-gradient(90deg,var(--emas),var(--emas2));
    border:none;font-weight:700;cursor:pointer;
}

table{width:100%;border-collapse:collapse;margin-top:20px;}
th,td{padding:14px;text-align:center;}
th{color:var(--emas);border-bottom:1px solid rgba(255,255,255,.2);}
img{width:60px;height:80px;border-radius:10px;object-fit:cover;}

a.hapus{color:#ff9b9b;font-weight:700;text-decoration:none;}
a.edit{color:#e6d3a3;font-weight:700;text-decoration:none;}
/* FOOTER */
footer{
    position:fixed;bottom:0;left:0;width:100%;
    background:rgba(55,42,33,0.65); /* sama dengan navbar */
    padding:14px;
    color:var(--emas-bright);
    text-align:center;
    border-top:1px solid var(--border-soft);
    backdrop-filter:blur(10px);
}

@keyframes fade{from{opacity:0;transform:translateY(20px)}to{opacity:1;transform:none}}
</style>
</head>

<body>
<?php include '../components/footer.php'; ?>
<div class="navbar">
    <span>ADMIN SIPUS</span>
    <a href="../logout.php">Keluar</a>
</div>

<div class="card">
<h2 style="text-align:center;color:var(--emas);margin-bottom:20px;">
    Manajemen Buku
</h2>

<form method="POST" enctype="multipart/form-data">

    <input type="hidden" name="id" value="<?= $edit['id'] ?? "" ?>">

    <input name="judul" placeholder="Judul Buku" required value="<?= $edit['judul'] ?? "" ?>">
    <input name="penulis" placeholder="Penulis" required value="<?= $edit['penulis'] ?? "" ?>">
    <input name="tahun" placeholder="Tahun Terbit" required value="<?= $edit['tahun'] ?? "" ?>">

    <input type="file" name="img">

    <select name="status" id="statusSelect" required>
        <option value="tersedia" <?= ($edit['status'] ?? '')=='tersedia'?'selected':'' ?>>Tersedia</option>
        <option value="dipinjam" <?= ($edit['status'] ?? '')=='dipinjam'?'selected':'' ?>>Sedang Dipinjam</option>
    </select>

    <input type="date" name="tanggal_kembali" id="tglKembali"
           value="<?= $edit['tanggal_kembali'] ?? '' ?>"
           style="display:none;">

    <input name="penerbit" placeholder="Penerbit" value="<?= $edit['penerbit'] ?? "" ?>">
    <input name="kota" placeholder="Kota Terbit" value="<?= $edit['kota'] ?? "" ?>">
    <input name="jumlah_halaman" placeholder="Jumlah Halaman" value="<?= $edit['jumlah_halaman'] ?? "" ?>">
    <input name="edisi" placeholder="Edisi" value="<?= $edit['edisi'] ?? "" ?>">
    <input name="cetakan" placeholder="Cetakan" value="<?= $edit['cetakan'] ?? "" ?>">
    <input name="jenis" placeholder="Jenis Buku" value="<?= $edit['jenis'] ?? "" ?>">

    <button name="save"><?= $edit ? "Update Buku" : "Tambah Buku" ?></button>

</form>

<table>
<tr>
    <th>No</th>
    <th>Cover</th>
    <th>Judul</th>
    <th>Penulis</th>
    <th>Penerbit</th>
    <th>Status</th>
    <th>Kembali</th>
    <th>Aksi</th>
</tr>

<?php $no=1; while($b=mysqli_fetch_assoc($buku)): ?>
<tr>
    <td><?= $no++ ?></td>
    <td><img src="../assets/img/<?= $b['img'] ?>">
</td>
    <td><?= $b['judul'] ?></td>
    <td><?= $b['penulis'] ?></td>
    <td><?= $b['penerbit'] ?? "-" ?></td>
    <td><?= $b['status'] ?></td>
    <td><?= $b['tanggal_kembali'] ?? "-" ?></td>

    <td>
        <a class="edit" href="admin_dashboard.php?edit=<?= $b['id'] ?>">Edit</a> |
        <a class="hapus" href="admin_dashboard.php?hapus=<?= $b['id'] ?>"
           onclick="return confirm('Hapus buku ini?')">Hapus</a>
    </td>
</tr>
<?php endwhile; ?>
</table>

</div>

<script>
document.getElementById("statusSelect").onchange = function() {
    if (this.value === "dipinjam") {
        document.getElementById("tglKembali").style.display = "block";
    } else {
        document.getElementById("tglKembali").style.display = "none";
    }
};

<?php if ($edit && $edit['status'] == "dipinjam"): ?>
document.getElementById("tglKembali").style.display = "block";
<?php endif; ?>
</script>

</body>
</html>
