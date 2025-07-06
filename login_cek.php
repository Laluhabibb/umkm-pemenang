<?php
session_start();
include 'koneksi.php'; // Sambungkan ke database

// Ambil data dari form login
$username = $_POST['username'];
$password = $_POST['password'];

// Query untuk cek username di database
$query = mysqli_query($koneksi, "SELECT * FROM tb_user WHERE username='$username'");
$cek = mysqli_num_rows($query);

if ($cek > 0) {
    $data = mysqli_fetch_assoc($query);

    // Pengecekan untuk admin tanpa password hash
    if ($data['jenis'] == "admin") {
        if ($password == $data['password']) {
            // Set session untuk admin
            $_SESSION['username'] = $username;
            $_SESSION['id_user'] = $data['id_user']; // Menyimpan id_user di session
            $_SESSION['jenis'] = "admin";
            header("Location: /umkmpemenang/.admin/index.php?pesan=berhasil"); // Redirect ke dashboard admin
            exit;
        } else {
            // Password salah
            header("Location: login.php?pesan=password_salah");
            exit;
        }

    // Pengecekan untuk member dengan password hash
    } else if ($data['jenis'] == "member") {
    if (password_verify($password, $data['password'])) {
        if ($data['status'] == "aktif") {
            // Set session untuk member yang aktif
            $_SESSION['username'] = $username;
            $_SESSION['id_user'] = $data['id_user']; // Menyimpan id_user di session
            $_SESSION['jenis'] = "member";
            header("Location: /umkmpemenang/.member/index.php?pesan=berhasil"); // Redirect ke dashboard member
            exit;
        } else {
            // Member belum diaktifkan oleh admin
            header("Location: login.php?pesan=belum_aktif");
            exit;
        }
    } else {
        // Password salah
        header("Location: login.php?pesan=password_salah");
        exit;
    }
}

} else {
    // Username tidak ditemukan
    header("Location: login.php?pesan=user_tidak_ditemukan");
    exit;
}
?>
