<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php?pesan=belum_login");
    exit;
}
include "../koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">
<?php include "header.php"; ?>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php include "menu_sidebar.php"; ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <?php include "menu_topbar.php"; ?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Kategori UMKM Desa Pemenang Barat</h6>
                            <a href="tambah_kategori.php" class="btn btn-primary btn-sm float-right">Tambah Kategori</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>Kategori UMKM</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 0;
                                        $data = mysqli_query($koneksi, "SELECT * FROM tb_kategori_umkm");
                                        while ($d = mysqli_fetch_array($data)) {
                                            $no++;
                                        ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo htmlspecialchars($d['nama_kategori']); ?></td>
                                                <td>
                                                    <a href="edit_kategori.php?id_kategori=<?php echo $d['id_kategori']; ?>" class="btn-sm btn-primary"><span class="fas fa-edit"></span></a>
                                                    <a href="hapus_kategori.php?id_kategori=<?php echo $d['id_kategori']; ?>" class="btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');"><span class="fas fa-trash"></span></a>
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
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
            <?php include "footer.php"; ?>
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
</body>

</html>