
<?php
include '../koneksi.php';

$id = $_GET['id_umkm'];

try {
    // Aktifkan mode exception jika belum
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    // Hapus UMKM
    $query = mysqli_query($koneksi, "DELETE FROM tb_umkm WHERE id_umkm = '$id'");

    echo "<script>alert('Data UMKM berhasil dihapus!'); window.location = 'tampil_data.php'</script>";

} catch (mysqli_sql_exception $e) {
    $errorMsg = $e->getMessage();

    if (strpos($errorMsg, 'foreign key constraint fails') !== false) {
        // Jika masih ada lokasi (marking) yang terhubung
        echo "<script>
                alert('Tidak bisa menghapus UMKM. Hapus dulu lokasi/penandaan (marking)-nya!');
                window.location = 'marking.php?id_umkm=$id';
              </script>";
    } else {
        // Error lain
        echo "<script>
                alert('Data UMKM gagal dihapus! Terjadi kesalahan.');
                window.location = 'tampil_data.php';
              </script>";
    }
}
?>
