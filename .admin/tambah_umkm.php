<!DOCTYPE html>
<html lang="en">
<?php
include "header.php";
include "../koneksi.php";

$id_kategori = "SELECT * FROM tb_kategori_umkm";
$kategori = $koneksi->query($id_kategori);
?>

<body id="page-top">
    <div id="wrapper">
        <?php include "menu_sidebar.php"; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "menu_topbar.php"; ?>

                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Tambah Data UMKM</h1>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Form Tambah UMKM</h6>
                        </div>
                        <div class="card-body">
                            <form class="form-horizontal style-form" action="tambah_aksi_umkm.php" method="post" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Nama UMKM</label>
                                    <div class="col-sm-6">
                                        <input name="nama_umkm" type="text" class="form-control" placeholder="Nama UMKM" required />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Nama Pemilik</label>
                                    <div class="col-sm-6">
                                        <input name="nama_pemilik" type="text" class="form-control" placeholder="Nama Pemilik" required />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Kategori</label>
                                    <div class="col-sm-6">
                                        <select name="id_kategori" class="form-control" required>
                                            <option value="">-- Pilih Kategori --</option>
                                            <?php while ($row = $kategori->fetch_assoc()) { ?>
                                                <option value="<?php echo $row['id_kategori']; ?>">
                                                    <?php echo $row['nama_kategori']; ?>
                                                </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Alamat</label>
                                    <div class="col-sm-6">
                                        <input name="alamat" type="text" class="form-control" placeholder="Alamat UMKM" required />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Deskripsi</label>
                                    <div class="col-sm-6">
                                        <textarea name="deskripsi" class="form-control" placeholder="Deskripsi UMKM" rows="3" required></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Kontak</label>
                                    <div class="col-sm-6">
                                        <input name="kontak" type="text" class="form-control" placeholder="Kontak (HP / WA)" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Nomor KTP</label>
                                    <div class="col-sm-6">
                                        <input name="no_ktp" type="text" class="form-control" placeholder="Nomor KTP (Opsional)" />
                                    </div>
                                </div>
                                
         <div class="form-group">
        <label class="col-sm-2 control-label">NIB</label>
        <div class="col-sm-6">
            <input name="nib" type="text" class="form-control" placeholder="Nomor Induk Berusaha (Opsional)" />
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">NPWP</label>
        <div class="col-sm-6">
            <input name="npwp" type="text" class="form-control" placeholder="Nomor NPWP (Opsional)" />
        </div>
    </div>

    <div class="form-group">
        <label class="col-sm-2 control-label">Tanggal Berdiri</label>
        <div class="col-sm-6">
            <input name="tanggal_berdiri" type="date" class="form-control" />
        </div>
    </div>
   
    <div class="form-group">
        <label class="col-sm-2 control-label">Foto Umkm</label>
        <div class="col-sm-6">
            <input name="foto" type="file" class="form-control" />
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