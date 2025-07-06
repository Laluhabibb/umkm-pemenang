<?php
session_start();
include '../koneksi.php';

// Ambil data dari form
$nama_user     = $_POST['nama_user'];
$alamat        = $_POST['alamat'];
$email         = $_POST['email'];
$jenis_kelamin = $_POST['jenis_kelamin'];
$status        = $_POST['status'];
$jenis         = $_POST['jenis'];
$username      = $_POST['username'];
$password      = $_POST['password']; // Simpan dengan hash (disarankan)

// Hash password
$password_hash = password_hash($password, PASSWORD_DEFAULT);

// Upload foto profil
$gambar        = $_FILES['gambar']['name'];
$tmp_gambar    = $_FILES['gambar']['tmp_name'];
$folder_upload = '../images/profil/';

// Jika ada file gambar diupload
if (!empty($gambar)) {
    $target_path = $folder_upload . basename($gambar);
    if (move_uploaded_file($tmp_gambar, $target_path)) {
        $query = "INSERT INTO tb_user (nama_user, alamat, email, jenis_kelamin, status, jenis, username, password, gambar)
                  VALUES ('$nama_user', '$alamat', '$email', '$jenis_kelamin', '$status', '$jenis', '$username', '$password_hash', '$gambar')";
    } else {
        echo "Gagal mengupload foto profil.";
        exit;
    }
} else {
    // Tanpa foto
    $query = "INSERT INTO tb_user (nama_user, alamat, email, jenis_kelamin, status, jenis, username, password)
              VALUES ('$nama_user', '$alamat', '$email', '$jenis_kelamin', '$status', '$jenis', '$username', '$password_hash')";
}

// Eksekusi query
if (mysqli_query($koneksi, $query)) {
    header("Location: user.php?pesan=sukses");
} else {
    echo "Gagal menyimpan data: " . mysqli_error($koneksi);
}
?>
