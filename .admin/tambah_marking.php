<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php?pesan=belum_login");
    exit;
}
include "../koneksi.php";

$query = mysqli_query($koneksi, "SELECT u.nama_umkm, m.latitude, m.longitude FROM tb_marking m JOIN tb_umkm u ON m.id_umkm = u.id_umkm");
$markers = [];
while ($data = mysqli_fetch_assoc($query)) {
    $markers[] = $data;
}
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
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Tambah Marking UMKM</h6>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="tambah_aksi_marking.php">
                                <div class="form-group">
                                    <label for="id_umkm">Nama UMKM</label>
                                    <select class="form-control" id="id_umkm" name="id_umkm" required>
    <option value="">Pilih UMKM</option>
    <?php
    $result = mysqli_query($koneksi, "SELECT id_umkm, nama_umkm FROM tb_umkm WHERE id_umkm NOT IN (SELECT id_umkm FROM tb_marking)");
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<option value='" . $row['id_umkm'] . "'>" . htmlspecialchars($row['nama_umkm']) . "</option>";
    }
    ?>
</select>

                                </div>

                                <!-- Peta untuk memilih marking -->
                                <div class="form-group">
                                    <label for="mapid">Lokasi Marking</label>
                                    <div id="mapid" style="height: 400px;"></div>
                                </div>

                                <div class="form-group">
                                    <label for="latitude">Latitude</label>
                                    <input type="text" class="form-control" id="latitude" name="latitude" required>
                                </div>
                                <div class="form-group">
                                    <label for="longitude">Longitude</label>
                                    <input type="text" class="form-control" id="longitude" name="longitude" required>
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="">Pilih Status</option>
                                        <option value="Aktif">Aktif</option>
                                        <option value="Tidak Aktif">Tidak Aktif</option>
                                    </select>
                                </div>
                                <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                                <a href="marking.php" class="btn btn-danger">Kembali</a>
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
    <!-- End of Page Wrapper -->

    <!-- Script untuk menampilkan peta dan mengambil koordinat -->
    <script>
        var map = L.map('mapid').setView([-8.404928699240921, 116.10008239746095], 13); // Sesuaikan lat, long dan zoom untuk peta Anda

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        var marker;

        var existingMarkers = <?php echo json_encode($markers); ?>;

    // Tampilkan semua marker lama di peta
    existingMarkers.forEach(function(marker) {
        L.marker([marker.latitude, marker.longitude])
            .addTo(map)
            .bindPopup(marker.nama_umkm);
    });

        // Fungsi untuk mendapatkan lat, long ketika pengguna klik peta
        map.on('click', function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;

            // Set nilai lat dan long ke form input
            document.getElementById('latitude').value = lat;
            document.getElementById('longitude').value = lng;

            // Tambahkan marker pada peta
            if (marker) {
                map.removeLayer(marker);
            }
            marker = L.marker([lat, lng]).addTo(map);
        });
    </script>
</body>

</html>