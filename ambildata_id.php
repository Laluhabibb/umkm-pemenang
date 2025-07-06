<?php
include "koneksi.php";
$Q = mysqli_query($koneksi, "SELECT * FROM tb_umkm where id_umkm=" . $id) or die(mysqli_error());
if ($Q) {
        $posts = array();
        if (mysqli_num_rows($Q)) {
                while ($post = mysqli_fetch_assoc($Q)) {
                        $posts[] = $post;
                }
        }
        $data = json_encode(array('results' => $posts));
}
?>

