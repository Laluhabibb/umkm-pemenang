<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php?pesan=belum_login");
    exit;
}

include "header.php";
include "../koneksi.php";

$id_umkm = $_GET['id_umkm'];

// Ambil data UMKM
$umkm = mysqli_query($koneksi, "SELECT * FROM tb_umkm WHERE id_umkm = '$id_umkm'");
$data = mysqli_fetch_assoc($umkm);

// Ambil data kategori
$kategori = mysqli_query($koneksi, "SELECT * FROM tb_kategori_umkm");
?>

<!DOCTYPE html>
<html lang="en">
<body id="page-top">
    <div id="wrapper">
        <?php include "menu_sidebar.php"; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "menu_topbar.php"; ?>

                <div class="container-fluid">
                    <h1 class="h3 mb-4 text-gray-800">Edit Data UMKM</h1>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Form Edit UMKM</h6>
                        </div>
                        <div class="card-body">
                            <form action="edit_aksi_umkm.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id_umkm" value="<?= $data['id_umkm']; ?>">

                                <div class="form-group">
                                    <label>Nama UMKM</label>
                                    <input type="text" name="nama_umkm" class="form-control" value="<?= htmlspecialchars($data['nama_umkm']); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label>Nama Pemilik</label>
                                    <input type="text" name="nama_pemilik" class="form-control" value="<?= htmlspecialchars($data['nama_pemilik']); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label>Kategori</label>
                                    <select name="id_kategori" class="form-control" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        <?php while ($row = mysqli_fetch_assoc($kategori)) { ?>
                                            <option value="<?= $row['id_kategori']; ?>" <?= $row['id_kategori'] == $data['id_kategori'] ? 'selected' : ''; ?>>
                                                <?= htmlspecialchars($row['nama_kategori']); ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input type="text" name="alamat" class="form-control" value="<?= htmlspecialchars($data['alamat']); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label>Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control" rows="3" required><?= htmlspecialchars($data['deskripsi']); ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Kontak</label>
                                    <input type="text" name="kontak" class="form-control" value="<?= htmlspecialchars($data['kontak']); ?>">
                                </div>

                                <div class="form-group">
                                    <label>Nomor KTP</label>
                                    <input type="text" name="no_ktp" class="form-control" value="<?= htmlspecialchars($data['no_ktp']); ?>">
                                </div>

                                <div class="form-group">
                                    <label>NIB</label>
                                    <input type="text" name="nib" class="form-control" value="<?= htmlspecialchars($data['nib']); ?>">
                                </div>

                                <div class="form-group">
                                    <label>NPWP</label>
                                    <input type="text" name="npwp" class="form-control" value="<?= htmlspecialchars($data['npwp']); ?>">
                                </div>

                                <div class="form-group">
                                    <label>Tanggal Berdiri</label>
                                    <input type="date" name="tanggal_berdiri" class="form-control" value="<?= $data['tanggal_berdiri']; ?>">
                                </div>

                                <div class="form-group">
                                    <label>Foto UMKM</label><br>
                                    <?php if (!empty($data['foto'])): ?>
                                        <img src="../images/<?= htmlspecialchars($data['foto']); ?>" alt="Foto UMKM" width="120" class="img-thumbnail mb-2"><br>
                                    <?php endif; ?>
                                    <input type="file" name="foto" class="form-control">
                                    <small>Kosongkan jika tidak ingin mengganti foto</small>
                                </div>

                                <button type="submit" class="btn btn-primary">Simpan </button>
                                <a href="tampil_data.php" class="btn btn-danger">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
                <?php include "footer.php"; ?>
            </div>
        </div>
    </div>
</body>
</html>
