<?php
// Koneksi ke database
include '../koneksi.php';

// Tangkap data dari form
$nama_kategori = mysqli_real_escape_string($koneksi, $_POST['nama_kategori']);

// Simpan ke database tanpa gambar
$query = "INSERT INTO tb_kategori_umkm (nama_kategori) VALUES ('$nama_kategori')";

if (mysqli_query($koneksi, $query)) {
    echo "<script>
        alert('Kategori berhasil ditambahkan!');
        window.location.href='kategori.php';
    </script>";
} else {
    echo "<script>
        alert('Gagal menambahkan kategori: " . mysqli_error($koneksi) . "');
        window.history.back();
    </script>";
}
