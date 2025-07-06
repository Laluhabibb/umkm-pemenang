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
                        <h1 class="h3 mb-0 text-gray-800">FAQ</h1>
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Daftar Pertanyaan dan Jawaban</h6>
                        </div>
                        <div class="card-body">
                            <?php
                            // Koneksi ke database
                            include '../koneksi.php'; // Sesuaikan path sesuai kebutuhan

                            // Cek jika koneksi berhasil
                            if (!$koneksi) {
                                die("Connection failed: " . mysqli_connect_error());
                            }

                            // Query untuk mengambil data dari tabel kontak
                            $query = "SELECT * FROM tb_faq";
                            $result = mysqli_query($koneksi, $query);

                            // Periksa jika query berhasil
                            if ($result) {
                                if (mysqli_num_rows($result) > 0) {
                                    echo '<table class="table table-bordered table-striped">';
                                    echo '<thead><tr>';
                                    echo '<th>No</th>';
                                    echo '<th>Pertanyaan</th>';
                                    echo '<th>Jawaban</th>';
                                    echo '<th>Aksi</th>';
                                    // echo '<th>Tanggal</th>';
                                    echo '</tr></thead>';
                                    echo '<tbody>';

                                    // Inisialisasi nomor urut
                                    $no = 1;

                                    // Loop melalui hasil query
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<tr>';
                                        echo '<td>' . $no . '</td>'; // Menampilkan nomor urut
                                        echo '<td>' . htmlspecialchars($row['pertanyaan']) . '</td>';
                                        echo '<td>' . htmlspecialchars($row['jawaban']) . '</td>';
                                        // echo '<td>' . htmlspecialchars($row['tanggal']) . '</td>';
                                        echo '<td><a href="hapus_pesan.php?id=' . htmlspecialchars($row['id_faq']) . '" class="btn btn-danger btn-sm" onclick="return confirmDelete();">Hapus</a></td>';
                                        echo '</tr>';

                                        // Increment nomor urut
                                        $no++;
                                    }

                                    echo '</tbody>';
                                    echo '</table>';
                                } else {
                                    echo '<p>Tidak ada pesan untuk ditampilkan.</p>';
                                }
                            } else {
                                echo '<p>Terjadi kesalahan saat mengambil data dari database: ' . mysqli_error($koneksi) . '</p>';
                            }

                            // Tutup koneksi
                            mysqli_close($koneksi);
                            ?>
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

    <!-- JavaScript untuk konfirmasi hapus -->
    <script>
        function confirmDelete() {
            return confirm("Apakah Anda yakin ingin menghapus pesan ini?");
        }
    </script>
</body>

</html>
