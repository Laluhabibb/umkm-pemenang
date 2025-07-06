<?php
// koneksi database
include '../koneksi.php';

// menangkap data id yang dikirim dari URL
$id = $_GET['id_faq'];

// Menghapus data dari tabel FAQ
$query = mysqli_query($koneksi, "DELETE FROM tb_faq WHERE id_faq='$id'");

if ($query) {
    echo "<script>alert('Data Berhasil Dihapus!'); window.location = 'faq.php';</script>";
} else {
    echo "<script>alert('Data Gagal Dihapus!'); window.location = 'faq.php';</script>";
}
?>
