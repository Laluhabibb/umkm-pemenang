<?php 
$id_umkm = isset($_GET['id_umkm']) ? (int)$_GET['id_umkm'] : null;

include "header.php"; 
include_once "koneksi.php";
?>

<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

<!-- Custom Fullscreen Button Style -->
<style>
    #map-container {
        position: relative;
        width: 100%;
        height: 480px;
        border-radius: 10px;
        overflow: hidden;
        transition: all 0.3s ease-in-out;
    }

    .leaflet-control-zoom {
        z-index: 10 !important;
        position: relative;
    }

    #map {
        width: 100%;
        height: 100%;
        z-index: 0;
    }

    #fullscreenBtn {
        position: absolute;
        top: 10px;
        right: 10px;
        background: #007bff;
        color: white;
        border: none;
        padding: 15px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 14px;
        box-shadow: 0 2px 6px rgba(0,0,0,0.3);
        z-index: 10;
        transition: background 0.3s;
        margin-right: 15px;
    }

    #fullscreenBtn:hover {
        background: #00000056;
       
    }

    .fullscreen-map {
        position: fixed !important;
        top: 0;
        left: 0;
        width: 100vw !important;
        height: 100vh !important;
        z-index: 9999;
        border-radius: 0 !important;
    }

    /* Custom Styles for the Main Section */
    main {
        background: rgba(255, 255, 255, 0.9);
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .title {
        margin-bottom: 20px;
    }

    .description {
        margin-bottom: 20px;
        color: #555;
    }

    .popup-content {
        text-align: center;
        font-family: Arial, sans-serif;
    }

    .popup-content h5 {
        font-weight: bold;
        color: #333;
    }

    .popup-content img {
        width: 160px;
        height: 100px;
        object-fit: cover;
        border-radius: 10px;
        margin-bottom: 10px;
    }

    .popup-content p {
        font-size: 14px;
        color: #555;
        margin: 5px 0;
    }

    .popup-content a {
        background-color: #007bff;
        color: white;
        font-weight: 500;
        padding: 6px 14px;
        border-radius: 5px;
        text-decoration: none;
        transition: background 0.3s;
    }

    .popup-content a:hover {
        background-color: #0056b3;
    }
</style>

<main id="main">
    <section class="price-area section-gap">
        <section id="peta_umkm" class="about-info-area section-gap" style="padding:0;">
            <div class="container" style="padding:0;">
                <div class="title text-center">
                    <h1 class="mb-10">Peta Lokasi UMKM Desa Pemenang Barat</h1>
                </div>
                <div class="description text-center">
                    <h5 class="mt-4">Klik marker untuk melihat lokasi UMKM.</h5>
                </div>
                <br>
                <div class="row align-items-center" style="margin:0;">
                    <div id="map-container">
                        <button id="fullscreenBtn" onclick="toggleFullscreen()">
                            <i class="bi bi-arrows-fullscreen" id="fullscreenIcon"></i>
                        </button>
                        <div id="map"></div>
                    </div>
                </div>
            </div>
        </section>
    </section>
</main>

<script type="text/javascript">
    var map = L.map('map').setView([-8.404928699240921, 116.10008239746095], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
    }).addTo(map);

    setTimeout(function () {
        map.invalidateSize();
    }, 200);

    var officeLocations = <?php
        $sql = "SELECT u.id_umkm, u.nama_umkm, u.alamat, u.foto, m.latitude, m.longitude 
                FROM tb_umkm u
                JOIN tb_marking m ON u.id_umkm = m.id_umkm";
        $result = mysqli_query($koneksi, $sql);
        $markers = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $markers[] = [
                'id_umkm' => $row['id_umkm'],
                'nama_umkm' => $row['nama_umkm'],
                'alamat' => $row['alamat'],
                'foto' => $row['foto'],
                'latitude' => $row['latitude'],
                'longitude' => $row['longitude']
            ];
        }
        echo json_encode($markers);
    ?>;

    function escapeHtml(text) {
        var map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return text.replace(/[&<>"']/g, function (m) { return map[m]; });
    }

    officeLocations.forEach(function(umkm) {
        var marker = L.marker([umkm.latitude, umkm.longitude]).addTo(map);

        var fotoSrc = umkm.foto && umkm.foto.trim() !== "" ? "images/" + umkm.foto : "images/default.png";

        var popupContent = `
            <div class="popup-content">
                <h5>${escapeHtml(umkm.nama_umkm)}</h5>
                <img src="${fotoSrc}" 
                     alt="Foto ${escapeHtml(umkm.nama_umkm)}" />
                <p><strong>Alamat:</strong><br>${escapeHtml(umkm.alamat)}</p>

                <div style="display:flex; justify-content:center; gap:8px; flex-wrap:wrap; margin-top:10px;">
                    <a href="detail.php?id=${umkm.id_umkm}" target="_blank">📄 Detail</a>
                    <a href="https://www.google.com/maps/dir/?api=1&destination=${umkm.latitude},${umkm.longitude}" target="_blank">🔍 Lihat Rute</a>
                </div>
            </div>
        `;

        marker.bindPopup(popupContent);

        if (<?php echo (int)$id_umkm; ?> === parseInt(umkm.id_umkm)) {
            map.setView([umkm.latitude, umkm.longitude], 18);
            marker.openPopup();
        }
    });

    function toggleFullscreen() {
        var mapContainer = document.getElementById("map-container");
        mapContainer.classList.toggle("fullscreen-map");
        setTimeout(function () {
            map.invalidateSize();
        }, 300);
    }
</script>

<?php include "footer.php"; ?>
