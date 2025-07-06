<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php?pesan=belum_login");
    exit;
}
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
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Tambah Kategori UMKM</h1>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Data</h6>
                        </div>
                        <div class="card-body">

                            <!-- Form Input -->
                            <form class="form-horizontal style-form" style="margin-top: 10px;" action="tambah_kategori_aksi.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Kategori UMKM</label>
                                    <div class="col-sm-6">
                                        <input name="nama_kategori" type="text" class="form-control" placeholder="Nama Kategori UMKM" required />
                                    </div>
                                </div>
                                <div class="form-group" style="margin-bottom: 20px;">
                                    <div class="col-sm-offset-2 col-sm-8">
                                        <input type="submit" value="Simpan" class="btn btn-primary" />
                                        <a href="kategori.php" class="btn btn-danger">Kembali</a>
                                    </div>
                                </div>
                                <div style="margin-top: 20px;"></div>
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