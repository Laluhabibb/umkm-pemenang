<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php?pesan=belum_login");
    exit;
}
include "../koneksi.php"; // Sambungkan ke database

// Ambil data dari form
$id_marking = $_POST['id_marking'];
$id_umkm = $_POST['id_umkm']; // Ganti id_wisata menjadi id_umkm
$latitude = $_POST['latitude'];
$longitude = $_POST['longitude'];
$status = $_POST['status'];

// Query untuk memperbarui data marking
$query = "UPDATE tb_marking SET id_umkm='$id_umkm', latitude='$latitude', longitude='$longitude', status='$status' WHERE id_marking='$id_marking'";

if (mysqli_query($koneksi, $query)) {
    header("Location: marking.php?pesan=update_berhasil"); // Redirect setelah berhasil
} else {
    header("Location: marking.php?pesan=gagal_update"); // Redirect jika gagal
}
