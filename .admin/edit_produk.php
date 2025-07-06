<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php?pesan=belum_login");
    exit;
}
include "../koneksi.php";

// Ambil ID produk dari URL
$id_produk = $_GET['id_produk'];

// Ambil data produk dari database
$query = mysqli_query($koneksi, "SELECT * FROM tb_produk_umkm WHERE id_produk = '$id_produk'");
$data = mysqli_fetch_assoc($query);
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
                <h1 class="h3 mb-4 text-gray-800">Edit Produk UMKM</h1>

                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Form Edit Produk</h6>
                    </div>
                    <div class="card-body">
                        <form action="edit_aksi_produk.php" method="POST" enctype="multipart/form-data">
                            <!-- Hidden ID Produk -->
                            <input type="hidden" name="id_produk" value="<?php echo $data['id_produk']; ?>">

                            <!-- Nama Produk -->
                            <div class="form-group">
                                <label>Nama Produk</label>
                                <input type="text" name="nama_produk" class="form-control" value="<?php echo htmlspecialchars($data['nama_produk']); ?>" required>
                            </div>

                            <!-- Foto Produk Lama -->
                            <div class="form-group">
                                <label>Foto Produk Saat Ini</label><br>
                                <img src="../images/produk/<?php echo htmlspecialchars($data['foto_produk']); ?>" alt="Foto Produk" width="150">
                            </div>

                            <!-- Upload Foto Baru -->
                            <div class="form-group">
                                <label>Ganti Foto (Opsional)</label>
                                <input type="file" name="foto_produk" class="form-control" accept="image/*">
                                <small class="text-muted">Kosongkan jika tidak ingin mengubah foto.</small>
                            </div>

                            <!-- Pilih UMKM -->
                            <div class="form-group">
                                <label>Pilih UMKM</label>
                                <select name="id_umkm" class="form-control" required>
                                    <option value="">-- Pilih UMKM --</option>
                                    <?php
                                    $umkm = mysqli_query($koneksi, "SELECT id_umkm, nama_umkm FROM tb_umkm");
                                    while ($row = mysqli_fetch_assoc($umkm)) {
                                        $selected = $row['id_umkm'] == $data['id_umkm'] ? 'selected' : '';
                                        echo "<option value='{$row['id_umkm']}' $selected>{$row['nama_umkm']}</option>";
                                    }
                                    ?>
                                </select>
                            </div>

                            <!-- Tombol -->
                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="produk_umkm.php" class="btn btn-secondary">Batal</a>
                        </form>
                    </div>
                </div>

            </div>
        </div>
        <?php include "footer.php"; ?>
    </div>
</div>
</body>
</html>
