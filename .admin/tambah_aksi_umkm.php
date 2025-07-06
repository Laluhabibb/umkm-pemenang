<?php
// koneksi database
include '../koneksi.php';
session_start();

// Cek apakah user sudah login dan id_user ada di session
if (!isset($_SESSION['id_user'])) {
    header("Location: ../login.php?pesan=belum_login");
    exit;
}

$id_user = $_SESSION['id_user'];

// Tangkap data dari form
$nama_umkm    = $_POST['nama_umkm'];
$nama_pemilik = $_POST['nama_pemilik'];
$alamat       = $_POST['alamat'];
$deskripsi    = $_POST['deskripsi'];
$kontak       = $_POST['kontak'];
$id_kategori  = $_POST['id_kategori'];
$nib             = $_POST['no_ktp'];
$nib             = $_POST['nib'];
$npwp            = $_POST['npwp'];
$tanggal_berdiri = $_POST['tanggal_berdiri'];



// === Upload foto lokasi ===
$foto_umkm     = $_FILES['foto']['name'];
$tmp_foto_umkm = $_FILES['foto']['tmp_name'];

// === Upload foto produk ===

$folder = '../images/';

// Proses upload
if (!empty($foto_umkm)) {
    move_uploaded_file($tmp_foto_lokasi, $folder . $foto_umkm);
}

// Query insert
$query = "INSERT INTO tb_umkm (
    nama_umkm, nama_pemilik, alamat, deskripsi, kontak, no_ktp,
    id_user, id_kategori, nib, npwp, tanggal_berdiri, 
    foto
) VALUES (
    '$nama_umkm', '$nama_pemilik', '$alamat', '$deskripsi', '$kontak', '$no_ktp',
    '$id_user', '$id_kategori', '$nib', '$npwp', '$tanggal_berdiri', 
    '$foto_umkm'
)";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    echo "<script>
        alert('Data umkm berhasil ditambahkan!');
        window.location.href='tampil_data.php';
    </script>";
} else {
    echo "<script>
        alert('Gagal memperbarui data: " . mysqli_error($koneksi) . "');
        window.history.back();
    </script>";
}
echo "Error saat menyimpan data: " . mysqli_error($koneksi);
?>