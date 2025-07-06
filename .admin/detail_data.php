<?php
session_start();
if (empty($_SESSION['username'])) {
    header('location:../index.php');
    exit();
} else {
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

                <?php
                $id = $_GET['id_wisata'];
                $query = mysqli_query($koneksi, "SELECT * FROM tb_wisata WHERE id_wisata='$id'");
                $data = mysqli_fetch_array($query);
                
                $id_kategori = $data['id_kategori_wisata'];
                $query_kategori = mysqli_query($koneksi, "SELECT nama FROM tb_kategori_wisata WHERE id_kategori_wisata='$id_kategori'");
                $kategori = mysqli_fetch_array($query_kategori);
                ?>

            <?php } ?>
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Detail Wisata <?php echo htmlspecialchars($data['nama_wisata']); ?></h1>
                </div>
                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Detail Wisata</h6>
                    </div>
                    <div class="card-body">
                        <!-- Main content -->
                        <div class="panel-body">
                            <table id="example" class="table table-hover table-bordered">
                                <tr>
                                    <td width="250">Nama Wisata</td>
                                    <td width="550"><?php echo htmlspecialchars($data['nama_wisata']); ?></td>
                                </tr>
                                <tr>
                                    <td width="250">Kategori Wisata</td>
                                    <td width="550"><?php echo htmlspecialchars($kategori['nama']); ?></td>
                                </tr>
                                <tr>
                                    <td>Alamat</td>
                                    <td><?php echo htmlspecialchars($data['alamat']); ?></td>
                                </tr>
                                <tr>
                                    <td>Keterangan</td>
                                    <td><?php echo htmlspecialchars($data['keterangan']); ?></td>
                                </tr>
                                <tr>
                                    <td>Biaya Parkir</td>
                                    <td>Rp. <?php echo htmlspecialchars($data['biaya_parkir']); ?></td>
                                </tr>
                                <tr>
                                    <td>Biaya Pondok</td>
                                    <td><?php echo htmlspecialchars($data['biaya_pondok']); ?></td>
                                </tr>
                                    <td>Gambar</td>
                                    <td>
                                        <?php if (!empty($data['foto'])): ?>
                                            <img src="<?php echo htmlspecialchars($data['foto']); ?>" alt="Gambar Wisata" width="200" />
                                        <?php else: ?>
                                            Tidak ada gambar
                                        <?php endif; ?>
                                    </td>
                                </tr>
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
