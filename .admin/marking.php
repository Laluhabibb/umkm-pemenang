<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php?pesan=belum_login");
    exit;
}
include "../koneksi.php"; // Koneksi database

// Proses penyimpanan marking
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_umkm = $_POST['id_umkm'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];

    // Query untuk menyimpan marking
    $query = "INSERT INTO tb_marking (id_umkm, latitude, longitude) VALUES ('$id_umkm', '$latitude', '$longitude')";

    if (mysqli_query($koneksi, $query)) {
        echo "<script>alert('Marking berhasil ditambahkan!'); window.location = 'marking.php'</script>";
    } else {
        echo "<script>alert('Gagal menambahkan marking.'); window.location = 'marking.php'</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include "header.php"; ?>

<body id="page-top">
    <div id="wrapper">
        <?php include "menu_sidebar.php"; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "menu_topbar.php"; ?>

                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data Marking Lokasi UMKM Desa Pemenang Barat</h6>
                            <a href="tambah_marking.php" class="btn btn-primary btn-sm float-right">Tambah Marking</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>Nama UMKM</th>
                                            <th>Latitude</th>
                                            <th>Longitude</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 0;
                                        $query = "
                                            SELECT 
                                                m.id_marking,
                                                u.nama_umkm,
                                                m.latitude,
                                                m.longitude,
                                                m.status
                                            FROM tb_marking m
                                            JOIN tb_umkm u ON m.id_umkm = u.id_umkm
                                        ";
                                        $data = mysqli_query($koneksi, $query);
                                        while ($d = mysqli_fetch_array($data)) {
                                            $no++;
                                        ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo htmlspecialchars($d['nama_umkm']); ?></td>
                                                <td><?php echo htmlspecialchars($d['latitude']); ?></td>
                                                <td><?php echo htmlspecialchars($d['longitude']); ?></td>
                                                <td><?php echo htmlspecialchars($d['status']); ?></td>
                                                <td>
                                                    <a href="edit_marking.php?id_marking=<?php echo $d['id_marking']; ?>" class="btn-sm btn-primary"><span class="fas fa-edit"></span></a>
                                                    <a href="hapus_marking.php?id_marking=<?php echo $d['id_marking']; ?>" class="btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');"><span class="fas fa-trash"></span></a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include "footer.php"; ?>
            </div>
        </div>
    </div>
</body>

</html>