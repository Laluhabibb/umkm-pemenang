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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Edit Data UMKM</h1>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Form Edit UMKM</h6>
                        </div>
                        <div class="card-body">

                            <?php
                            include '../koneksi.php';
                            $id_umkm = $_GET['id_umkm'];
                            $query = mysqli_query($koneksi, "SELECT * FROM tb_umkm WHERE id_umkm='$id_umkm'");
                            $data = mysqli_fetch_array($query);

                            $kategori_query = mysqli_query($koneksi, "SELECT * FROM tb_kategori_umkm");
                            ?>

                            <form class="form-horizontal style-form" action="edit_aksi_umkm.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id_umkm" value="<?= htmlspecialchars($data['id_umkm']); ?>">

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Nama UMKM</label>
                                    <div class="col-sm-8">
                                        <input name="nama_umkm" type="text" class="form-control" value="<?= htmlspecialchars($data['nama_umkm']); ?>" required />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Nama Pemilik</label>
                                    <div class="col-sm-8">
                                        <input name="nama_pemilik" type="text" class="form-control" value="<?= htmlspecialchars($data['nama_pemilik']); ?>" required />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Kategori</label>
                                    <div class="col-sm-8">
                                        <select name="id_kategori" class="form-control" required>
                                            <?php while ($kategori = mysqli_fetch_array($kategori_query)) { ?>
                                                <option value="<?= $kategori['id_kategori']; ?>" <?= ($kategori['id_kategori'] == $data['id_kategori']) ? 'selected' : ''; ?>>
                                                    <?= htmlspecialchars($kategori['nama_kategori']); ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Alamat</label>
                                    <div class="col-sm-8">
                                        <input name="alamat" type="text" class="form-control" value="<?= htmlspecialchars($data['alamat']); ?>" required />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Deskripsi</label>
                                    <div class="col-sm-8">
                                        <textarea name="deskripsi" class="form-control" rows="3" required><?= htmlspecialchars($data['deskripsi']); ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Kontak</label>
                                    <div class="col-sm-8">
                                        <input name="kontak" type="text" class="form-control" value="<?= htmlspecialchars($data['kontak']); ?>" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Foto</label>
                                    <div class="col-sm-8">
                                        <input name="foto" type="file" class="form-control" />
                                        <?php if (!empty($data['foto'])) { ?>
                                            <img src="../images/<?= htmlspecialchars($data['foto']); ?>" alt="Foto UMKM" style="margin-top:10px; width:100px;">
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-8">
                                        <input type="submit" value="Simpan" class="btn btn-primary" />
                                        <a href="tampil_data.php" class="btn btn-danger">Kembali</a>
                                    </div>
                                </div>
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