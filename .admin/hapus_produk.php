<?php
// koneksi database
include '../koneksi.php';

// menangkap data id yang di kirim dari url
$id = $_GET['id_produk'];

// Menghapus data dari tabel kontak
$query = mysqli_query($koneksi, "DELETE FROM tb_produk_umkm WHERE id_produk='$id'");
// menghapus data dari database
$query = mysqli_query($koneksi, "delete from tb_produk where id_produk='$id'");
if ($query) {
    echo "<script>alert('Data Berhasil Dihapus!'); window.location = 'produk_umkm.php'</script>";
} else {
    echo "<script>alert('Data Gagal Dihapus!'); window.location = 'produk_umkm.php'</script>";
}
