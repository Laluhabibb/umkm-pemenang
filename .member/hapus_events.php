<?php
// koneksi database
include '../koneksi.php';

// menangkap data id yang di kirim dari url
$id = $_GET['id_event'];

// Menghapus data dari tabel kontak
$query = mysqli_query($koneksi, "DELETE FROM tb_events WHERE id_event='$id'");
// menghapus data dari database
$query = mysqli_query($koneksi, "delete from tb_events where id_event='$id'");
if ($query) {
    echo "<script>alert('Data Berhasil Dihapus!'); window.location = 'events.php'</script>";
} else {
    echo "<script>alert('Data Gagal Dihapus!'); window.location = 'events.php'</script>";
}