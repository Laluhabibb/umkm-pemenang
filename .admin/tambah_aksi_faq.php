<?php
// Koneksi ke database
include '../koneksi.php';

// Tangkap data dari form
$pertanyaan = mysqli_real_escape_string($koneksi, $_POST['pertanyaan']);
$jawaban    = mysqli_real_escape_string($koneksi, $_POST['jawaban']);

// Query untuk insert data ke tabel FAQ
$query = "INSERT INTO tb_faq (pertanyaan, jawaban) VALUES ('$pertanyaan', '$jawaban')";

if (mysqli_query($koneksi, $query)) {
    header("Location: faq.php?pesan=success");
    exit;
} else {
    echo "Gagal menyimpan data ke database: " . mysqli_error($koneksi);
}
?>
