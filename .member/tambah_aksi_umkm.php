<?php
// koneksi database
include '../koneksi.php';
session_start();

// Cek apakah user sudah login dan id_user ada di session
if (!isset($_SESSION['id_user'])) {
    header("Location: ../login.php?pesan=belum_login");
    exit;
}

$id_user = $_SESSION['id_user'];

// Tangkap data dari form
$nama_umkm    = $_POST['nama_umkm'];
$nama_pemilik = $_POST['nama_pemilik'];
$alamat       = $_POST['alamat'];
$deskripsi    = $_POST['deskripsi'];
$kontak       = $_POST['kontak'];
$id_kategori  = $_POST['id_kategori'];

// Upload gambar
$folder = '../images/';
$gambar = $_FILES['foto']['name'];
$tmp_name = $_FILES['foto']['tmp_name'];
$uploadfile = $folder . basename($gambar);

// Validasi dan upload gambar
if (move_uploaded_file($tmp_name, $uploadfile)) {
    // Simpan ke database
    $query = "INSERT INTO tb_umkm (nama_umkm, nama_pemilik, alamat, deskripsi, kontak, id_user, id_kategori, foto) 
              VALUES ('$nama_umkm', '$nama_pemilik', '$alamat', '$deskripsi', '$kontak', '$id_user', '$id_kategori', '$gambar')";

    if (mysqli_query($koneksi, $query)) {
        header("Location: tampil_data.php?pesan=success");
    } else {
        echo "Error saat menyimpan data: " . mysqli_error($koneksi);
    }
} else {
    echo "Gagal mengupload gambar.";
}
