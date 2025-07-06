<?php
header('Content-Type: application/json'); // Menentukan bahwa output adalah JSON
include "koneksi.php";

// Pastikan $id terdefinisi dan aman (jika ingin filter berdasarkan ID, tapi di sini tidak digunakan)
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Query dengan JOIN ke tb_kategori_umkm
$query = "
    SELECT 
        tb_umkm.*, 
        tb_kategori_umkm.nama_kategori 
    FROM 
        tb_umkm 
    LEFT JOIN 
        tb_kategori_umkm 
        ON tb_umkm.id_kategori = tb_kategori_umkm.id_kategori
";

$result = mysqli_query($koneksi, $query) or die(json_encode(['error' => mysqli_error($koneksi)]));

$posts = [];
if ($result && mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $posts[] = $row;
    }
}

echo json_encode(['results' => $posts]);
