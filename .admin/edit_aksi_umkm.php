<?php
include '../koneksi.php';
session_start();

// Cek login
if (!isset($_SESSION['id_user'])) {
    header("Location: ../login.php?pesan=belum_login");
    exit;
}

$id_user = $_SESSION['id_user'];

// Ambil data dari form
$id_umkm          = $_POST['id_umkm'];
$nama_umkm        = $_POST['nama_umkm'];
$nama_pemilik     = $_POST['nama_pemilik'];
$alamat           = $_POST['alamat'];
$deskripsi        = $_POST['deskripsi'];
$kontak           = $_POST['kontak'];
$id_kategori      = $_POST['id_kategori'];
$no_ktp           = $_POST['no_ktp'];
$nib              = $_POST['nib'];
$npwp             = $_POST['npwp'];
$tanggal_berdiri  = $_POST['tanggal_berdiri'];

// ==== Foto Lokasi ====
$foto_umkm        = $_FILES['foto']['name'];
$tmp_foto_umkm    = $_FILES['foto']['tmp_name'];

$folder           = '../images/';

// Ambil data lama
$cek = mysqli_query($koneksi, "SELECT foto FROM tb_umkm WHERE id_umkm='$id_umkm'");
$data_lama = mysqli_fetch_assoc($cek);
$foto_lama = $data_lama['foto'];

// Jika ada upload baru
if (!empty($foto_umkm)) {
    $nama_baru_umkm = uniqid() . '_' . $foto_umkm;
    move_uploaded_file($tmp_foto_umkm, $folder . $nama_baru_umkm);
} else {
    $nama_baru_umkm = $foto_lama;
}

// Query Update
$query = "UPDATE tb_umkm SET
    nama_umkm = '$nama_umkm',
    nama_pemilik = '$nama_pemilik',
    alamat = '$alamat',
    deskripsi = '$deskripsi',
    kontak = '$kontak',
    id_kategori = '$id_kategori',
    no_ktp = '$no_ktp',
    nib = '$nib',
    npwp = '$npwp',
    tanggal_berdiri = '$tanggal_berdiri',
    foto = '$nama_baru_umkm'
    WHERE id_umkm = '$id_umkm'";

// Eksekusi
if (mysqli_query($koneksi, $query)) {
    echo "<script>
        alert('Data UMKM berhasil diperbarui!');
        window.location.href='tampil_data.php';
    </script>";
} else {
    echo "<script>
        alert('Gagal memperbarui data: " . mysqli_error($koneksi) . "');
        window.history.back();
    </script>";
}
?>
