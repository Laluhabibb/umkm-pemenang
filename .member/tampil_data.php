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

<!-- Custom CSS untuk Modal -->
<style>
    .modal-lg {
        max-width: 800px;
    }

    .modal-header {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        color: white;
        border-top-left-radius: 10px;
        border-top-right-radius: 10px;
    }

    .modal-content {
        border-radius: 15px;
        box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.3);
    }

    .modal-body {
        font-size: 16px;
        padding: 30px;
        line-height: 1.8;
    }

    .modal-body i {
        color: #2575fc;
        margin-right: 10px;
    }

    .btn-secondary {
        background: #2575fc;
        color: white;
        border: none;
        border-radius: 20px;
        padding: 10px 20px;
    }

    .btn-secondary:hover {
        background: #6a11cb;
    }

    .selengkapnya {
        font-size: 14px;
        color: #6a11cb;
        cursor: pointer;
        text-decoration: underline;
    }

    .modal.fade .modal-dialog {
        transform: scale(0.9);
        transition: transform 0.3s ease-in-out;
    }

    .modal.show .modal-dialog {
        transform: scale(1);
    }

    /* Menambahkan Scroll Horizontal */
    .table-responsive {
        overflow-x: auto;
    }

    .table {
        min-width: 100%;
    }
</style>

<body id="page-top">
    <div id="wrapper">
        <?php include "menu_sidebar.php"; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "menu_topbar.php"; ?>

                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Data UMKM Desa Pemenang Barat</h6>
                            <a href="tambah_umkm.php" class="btn btn-primary btn-sm float-right">Tambah UMKM</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <!-- Tabel Data UMKM -->
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>UMKM</th>
                                            <th>Pemilik</th>
                                            <th>Kategori</th>
                                            <th>Alamat</th>
                                            <th>Deskripsi</th>
                                            <th>Kontak</th>
                                            <th>Foto</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 0;
                                        $data = mysqli_query($koneksi, "SELECT tb_umkm.id_umkm, tb_umkm.nama_umkm, tb_umkm.nama_pemilik, tb_umkm.alamat, tb_umkm.deskripsi, tb_umkm.foto, tb_umkm.kontak, tb_kategori_umkm.nama_kategori 
                                    FROM tb_umkm 
                                    LEFT JOIN tb_kategori_umkm ON tb_umkm.id_kategori = tb_kategori_umkm.id_kategori");
                                        while ($d = mysqli_fetch_array($data)) {
                                            $no++;
                                            $alamat_singkat = strlen($d['alamat']) > 30 ? substr($d['alamat'], 0, 30) . '...' : $d['alamat'];
                                            $deskripsi_singkat = strlen($d['deskripsi']) > 50 ? substr($d['deskripsi'], 0, 50) . '...' : $d['deskripsi'];
                                            $kontak_singkat = strlen($d['kontak']) > 15 ? substr($d['kontak'], 0, 15) . '...' : $d['kontak'];
                                        ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><b><a href="tampil_data.php?id_umkm=<?php echo $d['id_umkm']; ?>"><?php echo htmlspecialchars($d['nama_umkm']); ?></a></b></td>
                                                <td><?php echo htmlspecialchars($d['nama_pemilik']); ?></td>
                                                <td><?php echo htmlspecialchars($d['nama_kategori']); ?></td>
                                                <td>
                                                    <?php echo htmlspecialchars($alamat_singkat); ?>
                                                    <?php if (strlen($d['alamat']) > 30): ?>
                                                        <span class="selengkapnya" data-toggle="modal" data-target="#modalDetail" data-judul="Alamat Lengkap" data-isi="<?php echo htmlspecialchars($d['alamat']); ?>">Selengkapnya</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($deskripsi_singkat); ?>
                                                    <?php if (strlen($d['deskripsi']) > 50): ?>
                                                        <span class="selengkapnya" data-toggle="modal" data-target="#modalDetail" data-judul="Deskripsi Lengkap" data-isi="<?php echo htmlspecialchars($d['deskripsi']); ?>">Selengkapnya</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php echo htmlspecialchars($kontak_singkat); ?>
                                                    <?php if (strlen($d['kontak']) > 15): ?>
                                                        <span class="selengkapnya" data-toggle="modal" data-target="#modalDetail" data-judul="Kontak Lengkap" data-isi="<?php echo htmlspecialchars($d['kontak']); ?>">Selengkapnya</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if (!empty($d['foto'])): ?>
                                                        <img src="../images/<?php echo htmlspecialchars($d['foto']); ?>" alt="Foto UMKM" width="100" class="img-thumbnail" />
                                                    <?php else: ?>
                                                        Tidak ada gambar
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <a href="edit_umkm.php?id_umkm=<?php echo $d['id_umkm']; ?>" class="btn-sm btn-primary"><span class="fas fa-edit"></span></a>
                                                    <a href="hapus_umkm.php?id_umkm=<?php echo $d['id_umkm']; ?>" class="btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?');"><span class="fas fa-trash"></span></a>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal untuk menampilkan detail alamat, deskripsi, dan kontak -->
                <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog" aria-labelledby="modalDetailLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalDetailLabel">Detail</h5>
                                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <i class="fas fa-info-circle fa-2x"></i>
                                <p id="modalIsi" style="margin-top: 20px;"></p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                </div>

                <?php include "footer.php"; ?>
            </div>
        </div>
    </div>

    <!-- Script untuk modal -->
    <script>
        document.querySelectorAll('.selengkapnya').forEach(function(element) {
            element.addEventListener('click', function() {
                var judul = this.getAttribute('data-judul');
                var isi = this.getAttribute('data-isi');
                document.getElementById('modalDetailLabel').textContent = judul;
                document.getElementById('modalIsi').textContent = isi;
            });
        });
    </script>
</body>

</html>