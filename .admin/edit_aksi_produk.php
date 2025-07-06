<?php

// Koneksi ke database
include "../koneksi.php";

// Ambil data dari form
$id_produk    = mysqli_real_escape_string($koneksi, $_POST['id_produk']);
$nama_produk = mysqli_real_escape_string($koneksi, $_POST['nama_produk']);
$id_umkm     = mysqli_real_escape_string($koneksi, $_POST['id_umkm']);

// Cek apakah user upload gambar baru
if (!empty($_FILES['foto_produk']['name'])) {
    $folder        = '../images/produk/';
    $foto_baru     = basename($_FILES['foto_produk']['name']);
    $upload_target = $folder . $foto_baru;

    // Proses upload file
    if (move_uploaded_file($_FILES['foto_produk']['tmp_name'], $upload_target)) {
        // Update data dengan foto baru
        $query = "UPDATE tb_produk_umkm 
                  SET nama_produk = '$nama_produk',
                      foto_produk = '$foto_baru',
                      id_umkm = '$id_umkm'
                  WHERE id_produk = '$id_produk'";
    } else {
        echo "<script>alert('Gagal mengupload foto baru.'); window.history.back();</script>";
        exit;
    }
} else {
    // Update data tanpa mengganti foto
    $query = "UPDATE tb_produk_umkm 
              SET nama_produk = '$nama_produk',
                  id_umkm = '$id_umkm'
              WHERE id_produk = '$id_produk'";
}

// Eksekusi query update
if (mysqli_query($koneksi, $query)) {
    echo "<script>alert('Produk berhasil diupdate.'); window.location='produk_umkm.php';</script>";
} else {
    echo "<script>alert('Gagal mengupdate produk: " . mysqli_error($koneksi) . "'); window.history.back();</script>";
}
?>
