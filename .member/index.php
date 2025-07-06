<?php
session_start(); // Memulai session PHP

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: ../login.php?pesan=belum_login");
    exit;
}

// Koneksi database
include "../koneksi.php";

// Query jumlah UMKM per kategori
$queryUmkmPerKategori = "
    SELECT k.nama_kategori, COUNT(u.id_umkm) as total_umkm 
    FROM tb_kategori_umkm k 
    LEFT JOIN tb_umkm u ON u.id_kategori = k.id_kategori
    GROUP BY k.nama_kategori
";

$resultUmkmPerKategori = mysqli_query($koneksi, $queryUmkmPerKategori);

$labelsKategori = [];
$dataUmkm = [];

while ($row = mysqli_fetch_assoc($resultUmkmPerKategori)) {
    $labelsKategori[] = $row['nama_kategori'];
    $totalUmkm = $row['total_umkm'];

    // Pastikan jumlah genap
    if ($totalUmkm % 2 != 0) {
        $totalUmkm++;
    }

    $dataUmkm[] = $totalUmkm;
}

$labelsKategoriJson = json_encode($labelsKategori);
$dataUmkmJson = json_encode($dataUmkm);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include "header.php"; ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        #kategoriUmkmChart {
            width: 800px;
            height: 450px;
            margin: auto;
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
                    <div class="row">
                        <div class="col-lg-12 col-md-12 mb-4">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Jumlah UMKM Berdasarkan Kategori</h6>
                                </div>
                                <div class="card-body">
                                    <canvas id="kategoriUmkmChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php include "footer.php"; ?>
            </div>
        </div>
    </div>

    <script>
        const labelsKategori = <?php echo $labelsKategoriJson; ?>;
        const dataUmkm = <?php echo $dataUmkmJson; ?>;

        const backgroundColors = labelsKategori.map(label => {
            if (label === 'Kuliner') {
                return 'rgba(255, 99, 132, 0.6)';
            } else if (label === 'Fashion') {
                return 'rgba(54, 162, 235, 0.6)';
            } else if (label === 'Kerajinan') {
                return 'rgba(255, 206, 86, 0.6)';
            } else if (label === 'Jasa') {
                return 'rgba(75, 192, 192, 0.6)';
            } else {
                return 'rgba(153, 102, 255, 0.6)';
            }
        });

        const kategoriUmkmChart = new Chart(document.getElementById('kategoriUmkmChart'), {
            type: 'bar',
            data: {
                labels: labelsKategori,
                datasets: [{
                    label: 'Jumlah UMKM',
                    data: dataUmkm,
                    backgroundColor: backgroundColors,
                    borderColor: backgroundColors,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Jumlah UMKM'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Kategori UMKM'
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    },
                    tooltip: {
                        enabled: true,
                        mode: 'index',
                        intersect: false
                    }
                }
            }
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>