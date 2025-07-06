<?php
// Koneksi ke database
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $nama_user = $_POST['nama_lengkap'];
    $alamat = $_POST['alamat'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Enkripsi password
    $jenis_kelamin = $_POST['jenis_kelamin'];
    
    // Proses upload gambar profil
    $gambar = $_FILES['profil']['name'];
    $tmp_name = $_FILES['profil']['tmp_name'];
    $folder = 'images/profil/';

    // Pastikan folder tujuan untuk profil sudah ada
    if (!file_exists($folder)) {
        mkdir($folder, 0777, true);
    }

    $profil_path = $folder . basename($gambar);

    // Validasi apakah file gambar berhasil di-upload
    if (move_uploaded_file($tmp_name, $profil_path)) {
        // Query untuk memasukkan data ke dalam tabel 'tb_user'
        $query = "INSERT INTO tb_user (nama_user, alamat, username, email, password, jenis_kelamin, gambar, jenis) 
                  VALUES ('$nama_user', '$alamat', '$username', '$email', '$password', '$jenis_kelamin', '$gambar', 'member')";

        if (mysqli_query($koneksi, $query)) {
            // Jika berhasil, arahkan ke halaman login dengan pesan sukses
            header("Location: login.php?pesan=daftar_sukses");
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Gagal mengupload gambar profil.";
    }
} else {
    // Jika method bukan POST, arahkan ke halaman daftar
    header("Location: daftar_member.php");
}
?>
