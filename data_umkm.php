<?php include "header.php"; ?>
<?php include "koneksi.php"; ?>

<!-- Start Banner Area -->
<section class="banner-area d-flex align-items-center text-center text-white" style="background: linear-gradient(135deg, rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('images/hero1.jpg') no-repeat center center/cover;">
    <div class="container">
        <h1 class="display-4 fw-bold text-white">UMKM Desa Pemenang Barat</h1>
        <p class="lead">Temukan berbagai produk dan layanan lokal terbaik dari UMKM kami</p>
    </div>
</section>
<!-- End Banner Area -->

<!-- Start About Info Area -->
<section class="about-info-area py-5 bg-light">
    <div class="container">
        <h2 class="text-center mb-5 fw-bold text-dark">Jelajahi UMKM Kami</h2>

        <!-- Form Pencarian -->
        <div class="row mb-5">
            <div class="col-md-8 mb-3 mb-md-0">
                <input type="text" id="searchInput" class="form-control form-control-lg rounded-pill shadow-sm" placeholder="Cari UMKM berdasarkan nama..." style="border-color: #e1e1e1;">
            </div>
            <div class="col-md-4">
                <select id="kategoriFilter" class="form-control form-control-lg rounded-pill shadow-sm" style="border-color: #e1e1e1;">
                    <option value="">-- Filter Berdasarkan Kategori --</option>
                    <?php
                    $kategori = mysqli_query($koneksi, "SELECT * FROM tb_kategori_umkm");
                    while ($row = mysqli_fetch_assoc($kategori)) {
                        echo "<option value='" . htmlspecialchars($row['nama_kategori']) . "'>" . htmlspecialchars($row['nama_kategori']) . "</option>";
                    }
                    ?>
                </select>
            </div>
        </div>

        <!-- Konten UMKM -->
<div class="row" id="umkmContainer">
    <div class="col-lg-12">
        <div class="row" id="umkmList">
            <?php
            $query = mysqli_query($koneksi, "
                SELECT 
                    tb_umkm.*, 
                    tb_kategori_umkm.nama_kategori 
                FROM 
                    tb_umkm 
                LEFT JOIN 
                    tb_kategori_umkm 
                    ON tb_umkm.id_kategori = tb_kategori_umkm.id_kategori
            ");

            if ($query && mysqli_num_rows($query) > 0) {
                while ($item = mysqli_fetch_assoc($query)) {
            ?>
                    <div class="col-lg-4 col-md-6 mb-4 umkm-card fade-in" 
                         data-nama="<?php echo strtolower($item['nama_umkm']); ?>" 
                         data-kategori="<?php echo strtolower($item['nama_kategori']); ?>">
                        <div class="card border-0 shadow-sm rounded-3 h-100">
                            <img src="images/<?php echo htmlspecialchars($item['foto']); ?>" 
                                 class="card-img-top rounded-top-3" 
                                 alt="Foto UMKM" 
                                 style="height: 200px; object-fit: cover;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold text-dark"><?php echo htmlspecialchars($item['nama_umkm']); ?></h5>
                                <p class="card-text text-muted">Pemilik: <?php echo htmlspecialchars($item['nama_pemilik']); ?></p>
                                <p class="card-text text-muted">Alamat: <?php echo htmlspecialchars($item['alamat']); ?></p>
                                <p class="card-text text-muted">Jenis: <?php echo htmlspecialchars($item['nama_kategori']); ?></p>
                                <p class="card-text text-muted flex-grow-1"><?php echo htmlspecialchars($item['deskripsi']); ?></p>
                                <a href="detail.php?id=<?php echo $item['id_umkm']; ?>" class="btn btn-primary rounded-pill mt-auto">Lihat Detail</a>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo "<div class='col-12'><div class='alert alert-warning text-center rounded-pill'>Data tidak tersedia.</div></div>";
            }
            ?>
        </div>
    </div>
</div>

    </div>
</section>
<!-- End About Info Area -->

<!-- Script Pencarian dan Filter Kategori -->
<script>
    document.getElementById("searchInput").addEventListener("input", filterUMKM);
    document.getElementById("kategoriFilter").addEventListener("change", filterUMKM);

    function filterUMKM() {
        const keyword = document.getElementById("searchInput").value.toLowerCase();
        const kategori = document.getElementById("kategoriFilter").value.toLowerCase();
        const cards = document.querySelectorAll(".umkm-card");

        cards.forEach((card) => {
            const nama = card.getAttribute("data-nama");
            const jenis = card.getAttribute("data-kategori");

            const cocokNama = nama.includes(keyword);
            const cocokKategori = !kategori || jenis === kategori;

            card.style.display = cocokNama && cocokKategori ? "block" : "none";
        });
    }
</script>

<!-- Custom CSS -->
<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f9fa;
    }

    .banner-area {
        height: 400px;
        background: linear-gradient(135deg, rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('images/banner.jpg') no-repeat center center/cover;
    }

    .fade-in {
        opacity: 0;
        transform: translateY(20px);
        animation: fadeIn 0.5s ease-out forwards;
    }

    @keyframes fadeIn {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        background-color: #fff;
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    }

    .btn-primary {
        background: linear-gradient(135deg, #0056b3, #00b7eb);
        border-color: #6b7280;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #0056b3, #00b7eb);
        transition: all 0.3s ease;
        border-color: #4b5563;
    }

    .form-control {
        background-color: #fff;
        border: 1px solid #e1e1e1;
        transition: border-color 0.3s ease;
    }

    .form-control:focus {
        border-color: #6b7280;
        box-shadow: 0 0 5px rgba(107, 114, 128, 0.3);
    }

    .alert-warning {
        background-color: #fef3c7;
        border-color: #fef3c7;
        color: #d97706;
    }
</style>

<?php include "footer.php"; ?>
