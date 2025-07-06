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
                        <h1 class="h3 mb-0 text-gray-800">Tambah User</h1>
                    </div>

                    <!-- Form Card -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Form Tambah User</h6>
                        </div>
                        <div class="card-body">

                            <form class="form-horizontal style-form" action="tambah_aksi_user.php" method="post" enctype="multipart/form-data">

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Nama</label>
                                    <div class="col-sm-6">
                                        <input name="nama_user" type="text" class="form-control" placeholder="Nama Lengkap" required />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Alamat</label>
                                    <div class="col-sm-6">
                                        <textarea name="alamat" class="form-control" placeholder="Alamat Lengkap" required></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-6">
                                        <input name="email" type="email" class="form-control" placeholder="Email" required />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Jenis Kelamin</label>
                                    <div class="col-sm-6">
                                        <select name="jenis_kelamin" class="form-control" required>
                                            <option value="">-- Pilih Jenis Kelamin --</option>
                                            <option value="Laki-laki">Laki-laki</option>
                                            <option value="Perempuan">Perempuan</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Status</label>
                                    <div class="col-sm-6">
                                        <select name="status" class="form-control" required>
                                            <option value="aktif">Aktif</option>
                                            <option value="nonaktif">Nonaktif</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Jenis</label>
                                    <div class="col-sm-6">
                                        <select name="jenis" class="form-control" required>
                                            <option value="admin">Admin</option>
                                            <option value="member">Member</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Username</label>
                                    <div class="col-sm-6">
                                        <input name="username" type="text" class="form-control" placeholder="Username" required />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Password</label>
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <input name="password" type="password" class="form-control" id="password" placeholder="Password">
                                            <div class="input-group-append">
                                                <span class="input-group-text" onclick="togglePassword()">
                                                    <i id="eyeIcon" class="fas fa-eye"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Foto Profil</label>
                                    <div class="col-sm-6">
                                        <input name="gambar" type="file" class="form-control" />
                                    </div>
                                </div>

                                <div class="form-group" style="margin-bottom: 20px;">
                                    <div class="col-sm-offset-2 col-sm-8">
                                        <input type="submit" value="Simpan" class="btn btn-primary" />
                                        <a href="user.php" class="btn btn-danger">Kembali</a>
                                    </div>
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
    </div>
    <script>
function togglePassword() {
    var passInput = document.getElementById("password");
    var icon = document.getElementById("eyeIcon");
    if (passInput.type === "password") {
        passInput.type = "text";
        icon.classList.remove("fa-eye");
        icon.classList.add("fa-eye-slash");
    } else {
        passInput.type = "password";
        icon.classList.remove("fa-eye-slash");
        icon.classList.add("fa-eye");
    }
}
</script>
</body>

</html>
