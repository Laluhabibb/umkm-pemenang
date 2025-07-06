<?php
session_start();
include "../koneksi.php";

if (isset($_POST['verifikasi'])) {
    $id_user = $_POST['id_user'];

    // Update status jadi aktif
    $query = mysqli_query($koneksi, "UPDATE tb_user SET status = 'aktif' WHERE id_user = '$id_user'");

    if ($query) {
        header("Location: user.php?pesan=berhasil_verifikasi");
    } else {
        header("Location: user.php?pesan=gagal_verifikasi");
    }
}
?>
