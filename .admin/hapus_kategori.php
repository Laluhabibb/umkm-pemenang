<?php
include '../koneksi.php';

$id = $_GET['id_kategori'];

try {
    // Aktifkan mode exception MySQLi
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    // Coba hapus kategori
    $query = mysqli_query($koneksi, "DELETE FROM tb_kategori_umkm WHERE id_kategori = '$id'");

    echo "<script>alert('Kategori berhasil dihapus!'); window.location = 'kategori.php'</script>";

} catch (mysqli_sql_exception $e) {
    $error = $e->getMessage();

    if (strpos($error, 'foreign key constraint fails') !== false) {
        echo "<script>
            alert('Tidak bisa menghapus kategori karena masih digunakan oleh UMKM. Silakan ubah atau hapus data UMKM terlebih dahulu.');
            window.location = 'tampil_data.php';
        </script>";
    } else {
        echo "<script>
            alert('Gagal menghapus kategori. Terjadi kesalahan.');
            window.location = 'kategori.php';
        </script>";
    }
}
?>
