<?php
// Mulai koneksi ke database
include '../koneksi.php';

// Tangkap data dari form
$id_faq     = mysqli_real_escape_string($koneksi, $_POST['id_faq']);
$pertanyaan = mysqli_real_escape_string($koneksi, $_POST['pertanyaan']);
$jawaban    = mysqli_real_escape_string($koneksi, $_POST['jawaban']);

// Query update FAQ
$query = "UPDATE tb_faq SET 
            pertanyaan = '$pertanyaan', 
            jawaban = '$jawaban' 
          WHERE id_faq = '$id_faq'";

// Eksekusi query
if (mysqli_query($koneksi, $query)) {
    header("Location: faq.php?pesan=update_sukses");
    exit;
} else {
    echo "Gagal mengupdate data: " . mysqli_error($koneksi);
}
