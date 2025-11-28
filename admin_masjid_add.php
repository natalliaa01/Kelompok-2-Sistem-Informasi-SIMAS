<?php
include "koneksi.php";
include "auth.php";
include "admin_layout_header.php";

// default tipe (untuk mushalla)
$tipe = $_GET['tipe'] ?? 'Masjid';

if ($_POST) {
    $nama = $_POST['nama'];
    $provinsi = $_POST['provinsi'];
    $kabupaten = $_POST['kabupaten'];
    $alamat = $_POST['alamat'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $tipe = $_POST['tipe'];

    mysqli_query($conn, "INSERT INTO masjid (nama, provinsi, kabupaten, alamat, latitude, longitude, tipe)
                         VALUES ('$nama', '$provinsi', '$kabupaten', '$alamat', '$latitude', '$longitude', '$tipe')");

    header("Location: admin_masjid.php");
    exit;
}
?>

<h1 class="text-2xl font-bold mb-6">Tambah <?= $tipe ?></h1>

<form method="post" class="grid gap-4 max-w-xl bg-white p-6 rounded-xl shadow">
  <input type="hidden" name="tipe" value="<?= $tipe ?>">

  <input name="nama" class="border p-2 rounded" placeholder="Nama <?= $tipe ?>" required>

  <input name="provinsi" class="border p-2 rounded" placeholder="Provinsi" required>

  <input name="kabupaten" class="border p-2 rounded" placeholder="Kabupaten" required>

  <textarea name="alamat" class="border p-2 rounded" placeholder="Alamat lengkap"></textarea>

  <input name="latitude" class="border p-2 rounded" placeholder="Latitude">

  <input name="longitude" class="border p-2 rounded" placeholder="Longitude">

  <button class="bg-emerald-600 text-white px-4 py-2 rounded">Simpan</button>
</form>

<?php include "admin_layout_footer.php"; ?>
