<?php
session_start();
include "../koneksi.php";

if (!isset($_SESSION['username'])) {
    header("Location: ../login.php?pesan=belum_login");
    exit;
}

if (!isset($_GET['id_user'])) {
    header("Location: user.php");
    exit;
}

$id_user = $_GET['id_user'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM tb_user WHERE id_user = '$id_user'"));
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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Edit User</h1>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Form Edit User</h6>
                        </div>
                        <div class="card-body">

                            <form class="form-horizontal style-form" action="edit_aksi_user.php" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="id_user" value="<?= $data['id_user']; ?>">

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Nama</label>
                                    <div class="col-sm-6">
                                        <input name="nama_user" type="text" class="form-control" value="<?= htmlspecialchars($data['nama_user']); ?>" required />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Alamat</label>
                                    <div class="col-sm-6">
                                        <textarea name="alamat" class="form-control" required><?= htmlspecialchars($data['alamat']); ?></textarea>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-6">
                                        <input name="email" type="email" class="form-control" value="<?= htmlspecialchars($data['email']); ?>" required />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Jenis Kelamin</label>
                                    <div class="col-sm-6">
                                        <select name="jenis_kelamin" class="form-control" required>
                                            <option value="Laki-laki" <?= ($data['jenis_kelamin'] == 'Laki-laki') ? 'selected' : ''; ?>>Laki-laki</option>
                                            <option value="Perempuan" <?= ($data['jenis_kelamin'] == 'Perempuan') ? 'selected' : ''; ?>>Perempuan</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Status</label>
                                    <div class="col-sm-6">
                                        <select name="status" class="form-control" required>
                                            <option value="aktif" <?= ($data['status'] == 'aktif') ? 'selected' : ''; ?>>Aktif</option>
                                            <option value="nonaktif" <?= ($data['status'] == 'nonaktif') ? 'selected' : ''; ?>>Nonaktif</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Jenis</label>
                                    <div class="col-sm-6">
                                        <select name="jenis" class="form-control" required>
                                            <option value="admin" <?= ($data['jenis'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                                            <option value="member" <?= ($data['jenis'] == 'member') ? 'selected' : ''; ?>>Member</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Username</label>
                                    <div class="col-sm-6">
                                        <input name="username" type="text" class="form-control" value="<?= htmlspecialchars($data['username']); ?>" required />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Password Baru</label>
                                    <div class="col-sm-6">
                                        <div class="input-group">
                                            <input name="password" type="password" class="form-control" id="password" placeholder="Kosongkan jika tidak ingin diubah">
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
                                        <?php if (!empty($data['gambar'])) { ?>
                                            <img src="../images/profil/<?= htmlspecialchars($data['gambar']); ?>" alt="Foto Profil" style="margin-top:10px; width:100px;" class="img-thumbnail">
                                        <?php } ?>
                                    </div>
                                </div>

                                <div class="form-group" style="margin-bottom: 20px;">
                                    <div class="col-sm-offset-2 col-sm-8">
                                        <input type="submit" value="Update" class="btn btn-primary" />
                                        <a href="user.php" class="btn btn-danger">Batal</a>
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

    <!-- Toggle Password Script -->
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
