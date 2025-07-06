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
    <div id="wrapper">
        <?php include "menu_sidebar.php"; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "menu_topbar.php"; ?>

                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center">
                            <h6 class="m-0 font-weight-bold text-primary">Produk UMKM</h6>
                            <a href="tambah_produk_umkm.php" class="btn btn-primary btn-sm">Tambah Produk</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="dataTable" width="100%" cellspacing="0">
                                    <thead class="thead-light text-center">
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Produk</th>
                                            <th>Foto Produk</th>
                                            <th>Nama UMKM</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $query = "SELECT tb_produk_umkm.*, tb_umkm.nama_umkm 
                                                  FROM tb_produk_umkm 
                                                  LEFT JOIN tb_umkm ON tb_produk_umkm.id_umkm = tb_umkm.id_umkm";
                                        $result = mysqli_query($koneksi, $query);

                                        while ($row = mysqli_fetch_assoc($result)) {
                                        ?>
                                            <tr class="text-center">
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo htmlspecialchars($row['nama_produk']); ?></td>
                                                <td>
                                                    <?php if (!empty($row['foto_produk'])) : ?>
                                                        <img src="../images/produk/<?php echo htmlspecialchars($row['foto_produk']); ?>" width="100" alt="Foto Produk">
                                                    <?php else : ?>
                                                        <span class="text-muted">Tidak ada gambar</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo htmlspecialchars($row['nama_umkm'] ?? ''); ?></td>
                                                <td>
                                                    <a href="edit_produk.php?id_produk=<?php echo $row['id_produk']; ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i></a>
                                                    <a href="hapus_produk.php?id_produk=<?php echo $row['id_produk']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus produk ini?')"><i class="fas fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include "footer.php"; ?>
        </div>
    </div>
</body>
</html>
