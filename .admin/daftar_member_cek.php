<?php
include '../koneksi.php'; // file koneksi ke database

// Ambil data dari form
$nama_lengkap = $_POST['nama_user'];
$alamat = $_POST['alamat'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Enkripsi password
$jenis_kelamin = $_POST['jenis_kelamin'];

// Query untuk memasukkan data ke database
$query = "INSERT INTO tb_user (nama_user, alamat, email, username, password, jenis_kelamin, jenis) 
          VALUES ('$nama_lengkap', '$alamat', '$email', '$username', '$password', '$jenis_kelamin', 'member')";

if (mysqli_query($koneksi, $query)) {
    // Redirect dengan pesan sukses
    header("location:login.php?pesan=daftar_sukses");
} else {
    echo "Pendaftaran gagal: " . mysqli_error($koneksi);
}

mysqli_close($koneksi);
?>
