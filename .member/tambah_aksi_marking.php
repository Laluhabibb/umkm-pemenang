<?php
session_start();
include "../koneksi.php";

// Pastikan user sudah login dan id_user ada di session
if (!isset($_SESSION['username']) || !isset($_SESSION['id_user'])) {
    header("Location: ../login.php?pesan=belum_login");
    exit;
}

// Ambil id_user dari session
$id_user = $_SESSION['id_user'];
$id_umkm = $_POST['id_umkm'];
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$status = $_POST['status'];

// Masukkan data marking ke dalam tabel tb_marking
$query = "INSERT INTO tb_marking (id_user, id_umkm, latitude, longitude, status) 
          VALUES ('$id_user', '$id_umkm', '$latitude', '$longitude', '$status')";

if (mysqli_query($koneksi, $query)) {
    header("Location: marking.php?pesan=sukses");
} else {
    echo "Error: " . mysqli_error($koneksi);
}

mysqli_close($koneksi);
