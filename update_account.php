<?php
session_start();
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Akses tidak valid');
}

$id       = $_POST['id'];
$username = $_POST['username'];
$email    = $_POST['email'];
$password = $_POST['password'];

if (!empty($password)) {
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $query = mysqli_query($koneksi,"
        UPDATE users 
        SET username='$username', email='$email', password='$passwordHash'
        WHERE id='$id'
    ");
} else {
    $query = mysqli_query($koneksi,"
        UPDATE users 
        SET username='$username', email='$email'
        WHERE id='$id'
    ");
}

if (!$query) {
    die(mysqli_error($koneksi));
}

header("Location: akun.php");
exit;
