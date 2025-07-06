<?php
// koneksi database
include '../koneksi.php';

// menangkap data id yang di kirim dari url
$id = $_GET['id_marking'];

// Menghapus data dari tabel kontak
$query = mysqli_query($koneksi, "DELETE FROM tb_marking WHERE id_marking='$id'");
// menghapus data dari database
$query = mysqli_query($koneksi, "delete from tb_marking where id_marking='$id'");
if ($query) {
    echo "<script>alert('Data Berhasil Dihapus!'); window.location = 'marking.php'</script>";
} else {
    echo "<script>alert('Data Gagal Dihapus!'); window.location = 'marking.php'</script>";
}
