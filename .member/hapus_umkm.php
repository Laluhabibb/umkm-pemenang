<?php
// koneksi database
include '../koneksi.php';

// menangkap data id yang di kirim dari url
$id = $_GET['id_umkm'];

// Menghapus data dari tabel kontak
$query = mysqli_query($koneksi, "DELETE FROM tb_umkm WHERE id_umkm='$id'");
// menghapus data dari database
$query = mysqli_query($koneksi, "delete from tb_umkm where id_umkm='$id'");
if ($query) {
    echo "<script>alert('Data Berhasil Dihapus!'); window.location = 'tampil_data.php'</script>";
} else {
    echo "<script>alert('Data Gagal Dihapus!'); window.location = 'tampil_data.php'</script>";
}
