<?php include "header.php"; ?>
<?php include "koneksi.php"; ?>

<!-- Start Banner Area -->
<!-- <section class="about-banner relative">
    <div class="overlay overlay-bg"></div>
</section> -->
<!-- End Banner Area -->

<!-- Start FAQ Area -->
<section class="about-info-area section-gap vh-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 info-center">
                <h2 class="mb-4 text-center">Frequently Asked Questions (FAQ)</h2>

                <div id="faqAccordion" class="accordion">
                    <?php
                    $query = "SELECT id_faq, pertanyaan, jawaban FROM tb_faq";
                    $result = mysqli_query($koneksi, $query);
                    $no = 0;

                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($faq = mysqli_fetch_assoc($result)) {
                            $no++;
                    ?>
                            <div class="card mb-2 mx-3 mx-md-5 border-0" style="background: rgba(255, 255, 255, 0.8); box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);">
                                <div class="card-header p-2" id="heading<?php echo $no; ?>" style="background-color: transparent;">
                                    <h5 class="mb-0">
                                        <button class="btn btn-link d-flex justify-content-between align-items-center w-100 text-dark" data-toggle="collapse" data-target="#collapse<?php echo $no; ?>" aria-expanded="<?php echo $no === 1 ? 'true' : 'false'; ?>" aria-controls="collapse<?php echo $no; ?>" style="text-align: left; font-weight: 500; font-size: 1.05rem;">
                                            <?php echo htmlspecialchars($faq['pertanyaan']); ?>
                                            <i class="fa fa-chevron-down ml-2"></i>
                                        </button>
                                    </h5>
                                </div>

                                <div id="collapse<?php echo $no; ?>" class="collapse <?php echo $no === 1 ? 'show' : ''; ?>" aria-labelledby="heading<?php echo $no; ?>" data-parent="#faqAccordion">
                                    <div class="card-body pt-0 pb-3 px-4" style="background: rgba(255, 255, 255, 0.6);">
                                    <?php
$jawaban = $faq['jawaban'];

// Ambil isi tag <a> (href dan teks-nya)
if (preg_match('/(.*?)<a\s+href=[\'"]([^\'"]+)[\'"][^>]*>(.*?)<\/a>/is', $jawaban, $matches)) {
    $teks_awal = strip_tags(trim($matches[1])); // "iyaa, silahkkan klik link ini"
    $url = $matches[2];                         // href link
    $label = $matches[3];                       // teks dalam <a>

    echo "$teks_awal <a href='$url' target='_blank'>$label</a>";
} else {
    // Jika tidak ada <a>, tampilkan apa adanya
    echo strip_tags($jawaban);
}
?>


                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo '<div class="alert alert-warning text-center">Belum ada data FAQ yang tersedia.</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End FAQ Area -->

<!-- Tambahan Font Awesome jika belum ada -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<?php include "footer.php"; ?>
