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
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
        <a href="tambah_user.php" class="btn btn-primary btn-sm float-right">Tambah User</a>
    </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>NO</th>
                                            <th>Nama</th>
                                            <th>Alamat</th>
                                            <th>Email</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Status</th>
                                            <th>Profil</th>
                                            <th>Jenis</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $no = 0;
                                        $data = mysqli_query($koneksi, "SELECT * FROM tb_user");
                                        while ($d = mysqli_fetch_array($data)) {
                                            $no++;
                                        ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><b><a href="user.php?id_user=<?php echo $d['id_user']; ?>"><?php echo htmlspecialchars($d['nama_user']); ?></a></b></td>
                                                <td><?php echo htmlspecialchars($d['alamat']); ?></td>
                                                <td><?php echo htmlspecialchars($d['email']); ?></td>
                                                <td><?php echo htmlspecialchars($d['jenis_kelamin']); ?></td>
                                                <td>
                                                    <?php if ($d['jenis'] == 'member' && $d['status'] == 'nonaktif'): ?>
                                                        <form method="post" action="verifikasi_user.php" style="display:inline;">
                                                            <input type="hidden" name="id_user" value="<?php echo $d['id_user']; ?>">
                                                            <button type="submit" name="verifikasi" class="btn btn-sm btn-success" onclick="return confirm('Aktifkan member ini?')">Aktifkan</button>
                                                        </form>
                                                    <?php else: ?>
                                                        <?php echo htmlspecialchars($d['status']); ?>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if (!empty($d['gambar'])): ?>
                                                        <img src="../images/profil/<?php echo htmlspecialchars($d['gambar']); ?>" alt="Profil User" width="100" />
                                                    <?php else: ?>
                                                        Tidak ada gambar
                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo htmlspecialchars($d['jenis']); ?></td>
                                                <td>
                                                    <a href="edit_user.php?id_user=<?php echo $d['id_user']; ?>" class="btn btn-sm btn-primary mb-1">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="hapus_user.php?id_user=<?php echo $d['id_user']; ?>" class="btn btn-sm btn-danger mb-1" onclick="return confirm('Yakin ingin menghapus user ini?')">
                                                        <i class="fas fa-trash"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
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
