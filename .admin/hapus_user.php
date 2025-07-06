<?php
// koneksi database
include '../koneksi.php';

// menangkap data id yang di kirim dari url
$id = $_GET['id_user'];

// Menghapus data dari tabel kontak
$query = mysqli_query($koneksi, "DELETE FROM tb_user WHERE id_user='$id'");
// menghapus data dari database
$query = mysqli_query($koneksi, "DELETE FROM tb_user WHERE id_user='$id'");
if ($query) {
    echo "<script>alert('Data Berhasil Dihapus!'); window.location = 'user.php'</script>";
} else {
    echo "<script>alert('Data Gagal Dihapus!'); window.location = 'user.php'</script>";
}
