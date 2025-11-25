<?php
include "koneksi.php";

$kab = $_GET['kab'];

$data = mysqli_query($conn,
  "SELECT kode, nama FROM wilayah 
   WHERE kode LIKE '$kab.%' AND CHAR_LENGTH(kode)=8
   ORDER BY nama"
);

echo '<option value="">Pilih Kecamatan</option>';

while ($d = mysqli_fetch_assoc($data)) {
  $cleanName = preg_replace('/^(Kecamatan)\s+/i', '', $d['nama']);
  echo '<option value="'.$d['kode'].'">'.$cleanName.'</option>';
}
