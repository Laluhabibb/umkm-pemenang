<?php
session_start();
include "../koneksi.php";

// Ambil data dari form
$id_user       = $_POST['id_user'];
$nama_user     = $_POST['nama_user'];
$alamat        = $_POST['alamat'];
$email         = $_POST['email'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$status        = $_POST['status'];
$jenis         = $_POST['jenis'];
$username      = $_POST['username'];
$password      = $_POST['password']; // bisa kosong kalau tidak diubah

// Ambil file foto jika ada
$gambar_baru   = $_FILES['gambar']['name'];
$tmp_name      = $_FILES['gambar']['tmp_name'];
$folder        = "../images/profil/";

// Ambil data lama (terutama gambar lama)
$result = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE id_user = '$id_user'");
$data   = mysqli_fetch_assoc($result);
$gambar_lama = $data['gambar'];

// === Proses upload foto baru (jika diunggah) ===
if (!empty($gambar_baru)) {
    move_uploaded_file($tmp_name, $folder . $gambar_baru);
} else {
    $gambar_baru = $gambar_lama; // pakai gambar lama
}

// === Proses hash password jika diubah ===
if (!empty($password)) {
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);
    $query = "UPDATE tb_user SET 
                nama_user     = '$nama_user',
                alamat        = '$alamat',
                email         = '$email',
                jenis_kelamin = '$jenis_kelamin',
                status        = '$status',
                jenis         = '$jenis',
                username      = '$username',
                password      = '$password_hashed',
                gambar        = '$gambar_baru'
              WHERE id_user = '$id_user'";
} else {
    // password tidak diubah
    $query = "UPDATE tb_user SET 
                nama_user     = '$nama_user',
                alamat        = '$alamat',
                email         = '$email',
                jenis_kelamin = '$jenis_kelamin',
                status        = '$status',
                jenis         = '$jenis',
                username      = '$username',
                gambar        = '$gambar_baru'
              WHERE id_user = '$id_user'";
}

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    header("Location: user.php?pesan=update_success");
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>
