<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php?pesan=belum_login");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<?php
include "header.php";
include "../koneksi.php";
?>

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
                        <h1 class="h3 mb-0 text-gray-800">Tambah Produk UMKM</h1>
                    </div>

                    <!-- Card -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Form Tambah Produk</h6>
                        </div>
                        <div class="card-body">
                            <form action="tambah_aksi_produk.php" method="POST" enctype="multipart/form-data">
                                <!-- Nama Produk -->
                                <div class="form-group">
                                    <label>Nama Produk</label>
                                    <input name="nama_produk" type="text" class="form-control" placeholder="Masukkan nama produk" required>
                                </div>

                                <!-- Foto Produk -->
                                <div class="form-group">
                                    <label>Foto Produk</label>
                                    <input type="file" name="foto_produk" class="form-control" accept="image/*" required>
                                </div>

                                <!-- Pilih UMKM -->
                                <div class="form-group">
                                    <label>Pilih UMKM</label>
                                    <select name="id_umkm" class="form-control" required>
                                        <option value="">-- Pilih UMKM --</option>
                                        <?php
                                        $umkm = mysqli_query($koneksi, "SELECT id_umkm, nama_umkm FROM tb_umkm");
                                        while ($row = mysqli_fetch_assoc($umkm)) {
                                            echo "<option value='{$row['id_umkm']}'>{$row['nama_umkm']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <!-- Tombol -->
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="produk.php" class="btn btn-danger">Kembali</a>
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
</body>
</html>
