<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php?pesan=belum_login");
    exit;
}
include "../koneksi.php";

if (!isset($_GET['id_faq'])) {
    header("Location: faq.php?pesan=invalid_id");
    exit;
}

$id_faq = intval($_GET['id_faq']);
$data = mysqli_query($koneksi, "SELECT * FROM tb_faq WHERE id_faq = $id_faq");
$faq = mysqli_fetch_assoc($data);

if (!$faq) {
    echo "Data FAQ tidak ditemukan.";
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
                        <h1 class="h3 mb-0 text-gray-800">Edit FAQ</h1>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Edit Pertanyaan dan Jawaban</h6>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal style-form" action="edit_aksi_faq.php" method="post">
                                <input type="hidden" name="id_faq" value="<?php echo $faq['id_faq']; ?>">

                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Pertanyaan</label>
                                    <div class="col-sm-6">
                                        <input name="pertanyaan" type="text" class="form-control" value="<?php echo htmlspecialchars($faq['pertanyaan']); ?>" required />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 col-sm-2 control-label">Jawaban</label>
                                    <div class="col-sm-6">
                                        <input name="jawaban" type="text" class="form-control" value="<?php echo htmlspecialchars($faq['jawaban']); ?>" required />
                                    </div>
                                </div>

                                <input type="submit" value="Simpan" class="btn btn-primary" />
                                <a href="faq.php" class="btn btn-danger">Kembali</a>
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
    </div>
</body>
</html>
