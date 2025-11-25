<?php
include "koneksi.php";

$tipe = isset($_GET['tipe']) ? trim($_GET['tipe']) : '';

$sql = "SELECT nama, latitude, longitude, kabupaten, provinsi, tipe 
        FROM masjid
        WHERE latitude IS NOT NULL AND longitude IS NOT NULL";

if ($tipe !== "") {
  $tipe = mysqli_real_escape_string($conn, $tipe);
  $sql .= " AND tipe = '$tipe'";
}

$q = mysqli_query($conn, $sql);

$data = [];
while ($row = mysqli_fetch_assoc($q)) {
  $data[] = $row;
}

header('Content-Type: application/json');
echo json_encode($data);
