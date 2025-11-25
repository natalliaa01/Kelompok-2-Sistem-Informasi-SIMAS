<?php
include "koneksi.php";

$prov = $_GET['prov'];

$data = mysqli_query($conn,
  "SELECT kode, nama FROM wilayah 
   WHERE kode LIKE '$prov.%' AND CHAR_LENGTH(kode)=5
   ORDER BY nama"
);

echo '<option value="">Pilih Kabupaten/Kota</option>';

while ($d = mysqli_fetch_assoc($data)) {

  // HILANGKAN PREFIX "Kabupaten " atau "Kota "
  $cleanName = preg_replace('/^(Kabupaten|Kota)\s+/i', '', $d['nama']);

  echo '<option value="'.$d['kode'].'">'.$cleanName.'</option>';
}
