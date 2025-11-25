<?php
$conn = mysqli_connect("localhost", "root", "", "simas_db");

if (!$conn) {
  die("Koneksi gagal: " . mysqli_connect_error());
}
?>
