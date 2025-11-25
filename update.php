<?php
include "koneksi.php";

$id  = $_POST['id'];
$nama = $_POST['nama'];
$prov = $_POST['provinsi'];
$kab  = $_POST['kabupaten'];
$lat  = $_POST['latitude'];
$lng  = $_POST['longitude'];

mysqli_query($conn, "UPDATE masjid SET
  nama='$nama',
  provinsi='$prov',
  kabupaten='$kab',
  latitude='$lat',
  longitude='$lng'
  WHERE id='$id'
");

header("Location: data.php");
exit;
