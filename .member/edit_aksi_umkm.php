<?php
// koneksi database
include '../koneksi.php';

// menangkap data yang dikirim dari form
$id_umkm = $_POST['id_umkm'];
$nama_umkm = $_POST['nama_umkm'];
$nama_pemilik = $_POST['nama_pemilik'];
$kategori = $_POST['id_kategori'];
$alamat = $_POST['alamat'];
$deskripsi = $_POST['deskripsi'];
$kontak = $_POST['kontak'];

// Mengatur direktori upload
$folder = '../images/';

// Mengambil data gambar dari input form
$gambar_baru = $_FILES['foto']['name'];
$tmp_name = $_FILES['foto']['tmp_name'];
$uploadfile = $folder . basename($gambar_baru);

// Mengecek jika gambar baru diupload
if (!empty($gambar_baru)) {
    // Proses upload gambar baru
    if (move_uploaded_file($tmp_name, $uploadfile)) {
        // Update database dengan gambar baru
        $query = "UPDATE tb_umkm SET nama_umkm='$nama_umkm', nama_pemilik='$nama_pemilik', alamat='$alamat', deskripsi='$deskripsi', kontak='$kontak', foto='$gambar_baru', id_kategori='$kategori' WHERE id_umkm='$id_umkm'";
    } else {
        echo "Gagal mengupload gambar.";
        exit;
    }
} else {
    // Jika tidak ada gambar baru, ambil gambar lama dari database
    $result = mysqli_query($koneksi, "SELECT foto FROM tb_umkm WHERE id_umkm='$id_umkm'");
    $data = mysqli_fetch_assoc($result);
    $gambar_lama = $data['foto'];

    // Update database tanpa mengubah gambar
    $query = "UPDATE tb_umkm SET nama_umkm='$nama_umkm', nama_pemilik='$nama_pemilik', alamat='$alamat', deskripsi='$deskripsi', kontak='$kontak', foto='$gambar_lama', id_kategori='$kategori' WHERE id_umkm='$id_umkm'";
}

// Menjalankan query
if (mysqli_query($koneksi, $query)) {
    // Mengalihkan halaman kembali ke tampil_data.php
    header("Location: tampil_data.php?pesan=success");
} else {
    echo "Error: " . mysqli_error($koneksi);
}
