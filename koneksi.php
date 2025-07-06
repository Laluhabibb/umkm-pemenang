<?php
$host = "btdpz7wwqggxbzy0sp0m-mysql.services.clever-cloud.com";
$user = "ups1n5rnrkw7fl6q";
$pass = "hfUfalukFjGAUM2vnFkx";
$name = "btdpz7wwqggxbzy0sp0m";

$koneksi = mysqli_connect($host, $user, $pass, $name);
if (mysqli_connect_errno()) {
    echo "Koneksi database mysqli gagal!!! : " . mysqli_connect_error();
}
//mysqli_select_db($name, $koneksi) or die("Tidak ada database yang dipilih!");
