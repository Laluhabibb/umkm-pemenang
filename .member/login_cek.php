<?php
session_start();
include '../koneksi.php'; // pastikan koneksi ke database

// Mengambil data dari form
$username = $_POST['username'];
$password = ($_POST['password']); // pastikan password di-enkripsi dengan metode yang sama saat disimpan

// Query untuk mengecek username dan password
$query = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username='$username' AND password='$password'");
$cek = mysqli_num_rows($query);

if ($cek > 0) {
    $data = mysqli_fetch_assoc($query);

    // Jika login sebagai admin
    if ($data['jenis'] == "admin") {
        // buat session login dan username
        $_SESSION['username'] = $username;
        $_SESSION['jenis'] = "admin";
        // alihkan ke halaman dashboard admin
        header("Location: admin/index.php");

    // Jika login sebagai member
    } else if ($data['jenis'] == "member") {
        // buat session login dan username
        $_SESSION['username'] = $username;
        $_SESSION['jenis'] = "member";
        // alihkan ke halaman dashboard member
        header("Location: member/index.php");

    } else {
        // jika jenis pengguna tidak dikenali
        header("Location: login.php?pesan=gagal");
    }
} else {
    // jika username atau password salah
    header("Location: login.php?pesan=gagal");
}
?>
