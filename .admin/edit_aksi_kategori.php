<?php
// koneksi database
include '../koneksi.php';

// menangkap data yang dikirim dari form
$id = $_POST['id_kategori'];
$nama = mysqli_real_escape_string($koneksi, $_POST['nama_kategori']);

// Query update tanpa icon karena kolom icon sudah dihapus
$query = "UPDATE tb_kategori_umkm SET nama_kategori='$nama' WHERE id_kategori='$id'";

// Menjalankan query
if (mysqli_query($koneksi, $query)) {
    echo "<script>
        alert('Data kategori berhasil diperbarui!');
        window.location.href='kategori.php';
    </script>";
} else {
    echo "<script>
        alert('Gagal memperbarui data: " . mysqli_error($koneksi) . "');
        window.history.back();
    </script>";
}
