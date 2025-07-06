<?php 
$id = $_GET['id'];
include "header.php";
include_once "koneksi.php";
include_once "ambildata_id.php";

// Decode JSON data from ambildata_id.php
$obj = json_decode($data);

// Variables for UMKM data
$id_umkm = "";
$nama_umkm = "";
$nama_pemilik = "";
$alamat = "";
$deskripsi = "";
$kontak = "";
$foto = "";

foreach ($obj->results as $item) {
  $id_umkm = $item->id_umkm;
  $nama_umkm = $item->nama_umkm;
  $nama_pemilik = $item->nama_pemilik;
  $alamat = $item->alamat;
  $deskripsi = $item->deskripsi;
  $kontak = $item->kontak;
  $foto = $item->foto;
}

// Fetch marking data (latitude and longitude)
$lat = $long = null;
$query = "SELECT latitude, longitude FROM tb_marking WHERE id_umkm = '$id_umkm'";
$result = mysqli_query($koneksi, $query);
if ($row = mysqli_fetch_assoc($result)) {
  $lat = $row['latitude'];
  $long = $row['longitude'];
}
?>

<!-- Leaflet CSS & JS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<!-- Start About Info Area -->
<section class="about-info-area section-gap">
  <div class="container">
    <div class="row">
      <!-- Kolom Kiri: Informasi UMKM -->
      <div class="col-md-6">
        <div class="panel panel-info panel-dashboard mb-4">
          <div class="panel-heading centered">
            <h2 class="panel-title text-center mt-3 mb-3"><strong>Informasi UMKM</strong></h2>
          </div>
          <div class="panel-body">
            <table class="table">
              <tr>
                <td>Nama UMKM</td>
                <td><h5><?php echo htmlspecialchars($nama_umkm); ?></h5></td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td><h5><?php echo htmlspecialchars($alamat); ?></h5></td>
              </tr>
              <tr>
                <td>Deskripsi</td>
                <td><h5 style="text-align: justify;"><?php echo htmlspecialchars($deskripsi); ?></h5></td>
              </tr>
              <tr>
                <td>Pesan</td>
                <td>
                  <?php
                  $kontak_wa = $kontak;
                  if (substr($kontak, 0, 1) === '0') {
                    $kontak_wa = '62' . substr($kontak, 1);
                  }
                  ?>
                  <form method="GET" action="https://api.whatsapp.com/send" target="_blank">
                    <input type="hidden" name="phone" value="<?php echo htmlspecialchars($kontak_wa); ?>">
                    <textarea name="text" id="pesan" class="form-control mb-2" rows="2" placeholder="Tulis pesan Anda..." required></textarea>
                    <button type="submit" class="btn btn-success btn-sm">
                      <i class="fab fa-whatsapp"></i> Kirim ke WhatsApp
                    </button>
                  </form>
                </td>
              </tr>
            </table>
          </div>
        </div>
      </div>

      <!-- Kolom Kanan: Produk UMKM -->
      <div class="col-md-6">
        <div class="panel panel-info panel-dashboard mb-4">
          <div class="panel-heading centered">
            <h2 class="panel-title text-center mt-3 mb-3"><strong>Produk UMKM</strong></h2>
          </div>
          <div class="panel-body">
            <div class="container-fluid">
              <div class="row">
                <?php
                $produk = mysqli_query($koneksi, "SELECT * FROM tb_produk_umkm WHERE id_umkm = '$id_umkm'");
                if (mysqli_num_rows($produk) > 0) {
                    while ($p = mysqli_fetch_assoc($produk)) {
                ?>
                  <div class="col-md-6 mb-5">
                    <div class="card h-100 shadow-sm">
                      <img src="images/produk/<?php echo htmlspecialchars($p['foto_produk']); ?>" class="card-img-top" alt="Foto Produk" style="height: 250px; object-fit: cover;">
                      <div class="card-body text-center">
                        <h6 class="card-title"><?php echo htmlspecialchars($p['nama_produk']); ?></h6>
                      </div>
                    </div>
                  </div>
                <?php
                    }
                } else {
                    echo '<div class="col-12 text-center text-muted mb-50">Belum ada produk ditambahkan.</div>';
                }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php if ($lat !== null && $long !== null): ?>
<div class="container-fluid">
  <div class="panel panel-info panel-dashboard">
    <div class="panel-heading centered">
      <h2 class="panel-title text-center mt-5"><strong>Lokasi</strong></h2>
    </div>
    <div class="panel-body m-5">
      <div id="map-canvas" style="width:100%;height:380px;"></div>
    </div>
  </div>
</div>
<?php endif; ?>

<!-- Leaflet Map Script -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    <?php if ($lat !== null && $long !== null): ?>
    var lat = <?php echo $lat; ?>;
    var long = <?php echo $long; ?>;
    var map = L.map('map-canvas').setView([lat, long], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '© OpenStreetMap'
    }).addTo(map);

    var foto = <?php echo json_encode($foto); ?>;
    var fotoUrl = foto ? 'images/' + foto : 'images/default.png';

    var popupContent = `
      <div class="popup-content text-center">
        <h5><?php echo htmlspecialchars($nama_umkm); ?></h5>
        <img src="${fotoUrl}" alt="Foto UMKM" style="width: 160px; height: 100px; object-fit: cover; border-radius: 8px;">
        <p><strong>Alamat:</strong><br><?php echo htmlspecialchars($alamat); ?></p>
        <a href="https://www.google.com/maps/dir/?api=1&destination=${lat},${long}" target="_blank" class="btn btn-sm btn-primary mt-2 text-white">🔍 Lihat Rute</a>
      </div>`;

    L.marker([lat, long]).addTo(map)
      .bindPopup(popupContent)
      .openPopup();
    <?php endif; ?>
  });
</script>

<!-- Custom CSS -->
<style>
  /* General Panel Styling */
  .leaflet-control-zoom {
        z-index: 10 !important;
        position: relative;
    }
  .panel {
    background-color: #f8fafc;
    border: none;
    border-radius: 16px;
    box-shadow: 0 6px 24px rgba(0, 0, 0, 0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    overflow: hidden;
  }

  .panel:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
  }

  .panel-heading {
    background: linear-gradient(135deg, #ffffff, #eaeaea);
    color: #ffffff;
    padding: 1.5rem;
    border-top-left-radius: 16px;
    border-top-right-radius: 16px;
  }

  .panel-title {
    font-size: 1.6rem;
    font-weight: 500;
    letter-spacing: 0.5px;
    font-family: 'Inter', sans-serif;
  }

  .panel-body {
    padding: 1rem;
    background-color: #ffffff;
    border-bottom-left-radius: 16px;
    border-bottom-right-radius: 16px;
  }

  /* Table Styling */
  .table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 0.75rem;
  }

  .table td {
    vertical-align: middle;
    padding: 1rem;
    border-bottom: 1px solid #e5e7eb;
  }

  .table td:first-child {
    font-weight: 500;
    color: #4b5563;
    width: 30%;
    font-family: 'Inter', sans-serif;
  }

  .table td h5 {
    margin: 0;
    color: #1f2937;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
  }

  /* Form Styling */
  .form-control {
    border-radius: 10px;
    border: 1px solid #d1d5db;
    padding: 0.75rem;
    background-color: #f9fafb;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
    font-family: 'Inter', sans-serif;
  }

  .form-control:focus {
    border-color: #a5b4fc;
    box-shadow: 0 0 0 3px rgba(165, 180, 252, 0.2);
    outline: none;
  }

  .btn-success {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white !important;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 10px;
    font-weight: 500;
    transition: background-color 0.3s ease, transform 0.2s ease;
    font-family: 'Inter', sans-serif;
  }

  .btn-success:hover {
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    transform: translateY(-2px);
  }

  /* Card Styling */
  .card {
    border: none;
    border-radius: 12px;
    background-color: #ffffff;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }

  .card:hover {
    transform: translateY(-6px);
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
  }

  .card-img-top {
    height: 160px;
    object-fit: cover;
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
    transition: transform 0.4s ease;
  }

  .card:hover .card-img-top {
    transform: scale(1.03);
  }

  .card-body {
    padding: 1.25rem;
  }

  .card-title {
    font-size: 1.1rem;
    font-weight: 500;
    color: #1f2937;
    margin-bottom: 0;
    font-family: 'Inter', sans-serif;
  }

  /* Map Styling */
  #map-canvas {
    border-radius: 16px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.06);
  }

  .popup-content {
    max-width: 220px;
  }

  .popup-content h5 {
    font-size: 1rem;
    font-weight: 500;
    margin-bottom: 0.5rem;
    color: #1f2937;
    font-family: 'Inter', sans-serif;
  }

  .popup-content p {
    font-size: 0.85rem;
    color: #6b7280;
    margin-bottom: 0.75rem;
    font-family: 'Inter', sans-serif;
  }

  .btn-primary {
    border: none;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-weight: 500;
    transition: background-color 0.3s ease, transform 0.2s ease;
    font-family: 'Inter', sans-serif;
  }

  .btn-primary:hover {
    transform: translateY(-2px);
  }

  /* Responsive Adjustments */
  @media (max-width: 768px) {
    .panel-title {
      font-size: 1.4rem;
    }

    .card-img-top {
      height: 140px;
    }

    .col-md-6 {
      margin-bottom: 1.5rem;
    }

    .panel-body {
      padding: 1.5rem;
    }
  }

  /* Font Import */
  @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap');
</style>

<?php include "footer.php"; ?>