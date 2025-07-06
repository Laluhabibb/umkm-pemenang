<?php
// Koneksi ke database
include '../koneksi.php';

// Tangkap data dari form
$nama_produk = mysqli_real_escape_string($koneksi, $_POST['nama_produk']);
$id_umkm     = mysqli_real_escape_string($koneksi, $_POST['id_umkm']);

// Lokasi folder upload gambar produk
$folder = '../images/produk/';
$foto_produk = basename($_FILES['foto_produk']['name']);
$tmp_name = $_FILES['foto_produk']['tmp_name'];
$uploadfile = $folder . $foto_produk;

// Proses upload gambar
if (move_uploaded_file($tmp_name, $uploadfile)) {
    // Simpan ke database
    $query = "INSERT INTO tb_produk_umkm (nama_produk, foto_produk, id_umkm) 
              VALUES ('$nama_produk', '$foto_produk', '$id_umkm')";

    if (mysqli_query($koneksi, $query)) {
        header("Location: produk_umkm.php?pesan=success");
        exit;
    } else {
        echo "Gagal menyimpan data ke database: " . mysqli_error($koneksi);
    }
} else {
    echo "Gagal mengupload gambar.";
}
?>
