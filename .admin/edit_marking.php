<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php?pesan=belum_login");
    exit;
}
include "../koneksi.php"; // Sambungkan ke database

// Ambil id_marking dari URL
$id_marking = $_GET['id_marking'];

// Query untuk mendapatkan data marking berdasarkan id_marking
$query = mysqli_query($koneksi, "SELECT * FROM tb_marking WHERE id_marking='$id_marking'");
$data = mysqli_fetch_assoc($query);

// Jika data tidak ditemukan
if (!$data) {
    header("Location: marking.php?pesan=data_tidak_ditemukan");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edit Marking UMKM</title>
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
</head>

<body id="page-top">
    <div id="wrapper">
        <?php include "menu_sidebar.php"; ?>
        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <?php include "menu_topbar.php"; ?>
                <div class="container-fluid">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Edit Marking UMKM</h6>
                        </div>
                        <div class="card-body">
                            <form method="POST" action="edit_aksi_marking.php">
                                <input type="hidden" name="id_marking" value="<?php echo $data['id_marking']; ?>">
                                <div class="form-group">
                                    <label for="id_umkm">Nama UMKM</label>
                                    <select class="form-control" id="id_umkm" name="id_umkm" required>
                                        <option value="">Pilih UMKM</option>
                                        <?php
                                        $result = mysqli_query($koneksi, "SELECT id_umkm, nama_umkm FROM tb_umkm");
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $selected = ($row['id_umkm'] == $data['id_umkm']) ? 'selected' : '';
                                            echo "<option value='" . $row['id_umkm'] . "' $selected>" . htmlspecialchars($row['nama_umkm']) . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <!-- Peta untuk memilih lokasi -->
                                <div class="form-group">
                                    <label for="map">Pilih Lokasi di Peta</label>
                                    <div id="map"></div>
                                </div>

                                <!-- Latitude dan Longitude diisi otomatis berdasarkan marker di peta -->
                                <div class="form-group">
                                    <label for="latitude">Latitude</label>
                                    <input type="text" class="form-control" id="latitude" name="latitude" value="<?php echo htmlspecialchars($data['latitude']); ?>" required>
                                </div>
                                <div class="form-group">
                                    <label for="longitude">Longitude</label>
                                    <input type="text" class="form-control" id="longitude" name="longitude" value="<?php echo htmlspecialchars($data['longitude']); ?>" required>
                                </div>

                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="Aktif" <?php echo ($data['status'] == 'Aktif') ? 'selected' : ''; ?>>Aktif</option>
                                        <option value="Tidak Aktif" <?php echo ($data['status'] == 'Tidak Aktif') ? 'selected' : ''; ?>>Tidak Aktif</option>
                                    </select>
                                </div>

                                <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
                                <a href="marking.php" class="btn btn-danger">Kembali</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php include "footer.php"; ?>
        </div>
    </div>

    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <script>
        // Atur peta
        var map = L.map('map').setView([<?php echo $data['latitude']; ?>, <?php echo $data['longitude']; ?>], 13);

        // Tile Layer menggunakan OSM (OpenStreetMap)
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
        }).addTo(map);

        // Marker untuk lokasi yang sedang diedit
        var marker = L.marker([<?php echo $data['latitude']; ?>, <?php echo $data['longitude']; ?>], {
            draggable: true
        }).addTo(map);

        // Update latitude dan longitude ketika marker digeser
        marker.on('dragend', function(e) {
            var latLng = marker.getLatLng();
            document.getElementById('latitude').value = latLng.lat;
            document.getElementById('longitude').value = latLng.lng;
        });

        // Fungsi untuk menampilkan marker di peta berdasarkan koordinat input
        function updateMarkerByInputs() {
            var lat = document.getElementById('latitude').value;
            var lng = document.getElementById('longitude').value;
            marker.setLatLng([lat, lng]);
            map.setView([lat, lng], 13);
        }

        // Update marker ketika koordinat diinput secara manual
        document.getElementById('latitude').addEventListener('input', updateMarkerByInputs);
        document.getElementById('longitude').addEventListener('input', updateMarkerByInputs);
    </script>
</body>

</html>