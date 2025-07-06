<?php include "header.php"; ?>
<?php include "koneksi.php"; // Masukkan file koneksi ke database jika diperlukan ?>

<!-- Start Banner Area -->
<section class="banner-area relative" style="background: url('images/umkmu.jpg') no-repeat center center/cover;">
    <div class="overlay overlay-bg"></div>
    <div class="container">
        <div class="row fullscreen align-items-center justify-content-between">
            <div class="col-lg-6 col-md-6 banner-left">
                <h6 class="text-white">SISTEM INFORMASI GEOGRAFIS UMKM</h6>
                <h1 class="text-white">Desa Pemenang Barat</h1>
                <h6 class="text-white">
                    Sistem informasi ini merupakan aplikasi pemetaan geografis UMKM yang ada di Desa Pemenang Barat.
                </h6>
                <a href="data_umkm.php" class="button mt-3 text-uppercase">Lihat Detail</a>
            </div>
        </div>
    </div>
</section>
<!-- End Banner Area -->

<main id="main">
    <!-- Start Catalog Area (Katalog UMKM Terbaru) -->
    <section id="catalog" class="catalog-area section-gap">
        <div class="container">
            <div class="title text-center mb-5">
                <h1 class="mb-10">UMKM Terbaru</h1>
                <p class="text-muted">Jelajahi UMKM Terbaru Desa Pemenang</p>
                <br>
            </div>
            <div class="row">
                <?php
                // Query untuk mengambil data UMKM dari tb_umkm
                $query = "SELECT u.*, k.nama_kategori 
          FROM tb_umkm u 
          JOIN tb_kategori_umkm k ON u.id_kategori = k.id_kategori 
          ORDER BY u.id_umkm DESC 
          LIMIT 8";
                // Ambil 8 data UMKM
                $result = mysqli_query($koneksi, $query);

                // Tampilkan data UMKM
                if ($result && mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $id = htmlspecialchars($row['id_umkm']);
                        $nama = htmlspecialchars($row['nama_umkm']);
                        $kategori = htmlspecialchars($row['nama_kategori']);
                        $foto = !empty($row['foto']) ? 'images/' . htmlspecialchars($row['foto']) : 'images/default.png';

                        echo '
                        <div class="col-lg-3 col-md-6 mb-4 ">
                            <a href="detail.php?id=' . $id . '" style="text-decoration: none; color: inherit;">
                                <div class="single-catalog shadow-sm" style="transition: transform 0.3s; animation: fadeIn 0.6s ease-in-out;">
                                    <img src="' . $foto . '" class="img-fluid" alt="' . $nama . '" style="width: 100%; height: 200px; object-fit: cover; border-radius: 8px;">
                                    <div class="catalog-content text-center mt-3 mb-30">
                                   <span class="badge bg-info text-light m-2 px-2" style="font-size: 1rem;">' . $kategori . '</span>
                                        <h4>' . $nama . '</h4>
                                    </div>
                                </div>
                            </a>
                        </div>';
                    }
                } else {
                    echo '<div class="col-12 text-center">
                            <div class="alert alert-info">
                                <p>Tidak ada data UMKM yang ditemukan.</p>
                            </div>
                          </div>';
                }
                ?>
            </div>
        </div>
    </section>
    <!-- End Catalog Area -->

    <?php include "footer.php"; ?>
</main>

<!-- Custom CSS -->
<style>
      @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&family=Roboto:wght@400;500&display=swap');
body {
    font-family: 'Poppins', sans-serif;
}

   /* Efek hover pada card catalog */
.single-catalog {
    border-radius: 12px;
    box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.35s ease, box-shadow 0.35s ease;
    cursor: pointer;
    background-color: #fff;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    height: 100%;
}

.single-catalog img {
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
    transition: transform 0.35s ease;
}

.button {
    display: inline-block;
  padding: 10px 20px;
  background: linear-gradient(135deg, #007bff, #00d4ff);
  color: #fff;
  text-decoration: none;
  border-radius: 10px;
  font-weight: 600;
  letter-spacing: 1px;
  transition: all 0.3s ease;
  box-shadow: 0 4px 15px rgba(0, 123, 255, 0.3);
}

.button:hover {
  background: linear-gradient(135deg, #0056b3, #00b7eb);
  transform: translateY(-2px);
  color: #fff;
}
.badge {
    background: linear-gradient(135deg, #0056b3, #00b7eb);
}

/* Hover effect */
.single-catalog:hover {
    transform: translateY(-8px) scale(1.05);
    box-shadow: 0 15px 25px rgba(0, 0, 0, 0.25);
}

.single-catalog:hover img {
    transform: scale(1.1);
}

/* Animasi Fade In */
@keyframes fadeIn {
    0% {
        opacity: 0;
        transform: translateY(10px);
    }

    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

</style>
