<?php
include "koneksi.php";

$nama = $_POST['nama'];
$prov = $_POST['provinsi'];
$kab = $_POST['kabupaten'];
$lat = $_POST['latitude'];
$lng = $_POST['longitude'];

mysqli_query($conn, "INSERT INTO masjid (nama, provinsi, kabupaten, latitude, longitude)
VALUES ('$nama', '$prov', '$kab', '$lat', '$lng')");

header("Location: data.php");
exit;
