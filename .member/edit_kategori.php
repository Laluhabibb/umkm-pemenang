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
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Edit Data Kategori UMKM</h1>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Edit Data</h6>
                        </div>
                        <div class="card-body">
                            <?php
                            include '../koneksi.php';
                            $id = $_GET['id_kategori'];
                            $query = mysqli_query($koneksi, "SELECT * FROM tb_kategori_umkm WHERE id_kategori='$id'");
                            $data = mysqli_fetch_array($query);
                            ?>

                            <form class="form-horizontal" action="edit_aksi_kategori.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>ID Kategori UMKM</label>
                                    <input name="id_kategori" type="text" class="form-control" value="<?php echo htmlspecialchars($data['id_kategori']); ?>" readonly />
                                </div>
                                <div class="form-group">
                                    <label>Nama Kategori UMKM</label>
                                    <input name="nama_kategori" type="text" class="form-control" value="<?php echo htmlspecialchars($data['nama_kategori']); ?>" required />
                                </div>
                                <div class="form-group">
                                    <label>Icon</label>
                                    <input name="icon" class="form-control" type="file" />
                                    <?php if (!empty($data['icon'])) { ?>
                                        <img src="../images/<?php echo htmlspecialchars($data['icon']); ?>" alt="Icon" style="margin-top: 10px; width: 100px;">
                                    <?php } ?>
                                </div>
                                <div class="form-group">
                                    <input type="submit" value="Simpan" class="btn btn-primary" />
                                    <a href="kategori.php" class="btn btn-danger">Kembali</a>
                                </div>
                            </form>
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