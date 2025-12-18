<?php
require "koneksi.php";

$q = mysqli_query($koneksi, "SELECT * FROM users");
$d = mysqli_fetch_assoc($q);

echo "<pre>";
var_dump($d);
echo "</pre>";