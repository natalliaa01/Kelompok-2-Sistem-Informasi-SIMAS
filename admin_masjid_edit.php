<?php
include "koneksi.php";
include "auth.php";
include "admin_layout_header.php";

$id = $_GET['id'];
$q = mysqli_query($conn, "SELECT * FROM masjid WHERE id=$id");
$data = mysqli_fetch_assoc($q);

if ($_POST) {
    $nama = $_POST['nama'];
    $provinsi = $_POST['provinsi'];
    $kabupaten = $_POST['kabupaten'];
    $alamat = $_POST['alamat'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $tipe = $_POST['tipe'];

    mysqli_query($conn, "UPDATE masjid SET
        nama='$nama',
        provinsi='$provinsi',
        kabupaten='$kabupaten',
        alamat='$alamat',
        latitude='$latitude',
        longitude='$longitude',
        tipe='$tipe'
        WHERE id=$id
    ");

    header("Location: admin_masjid.php");
    exit;
}
?>

<h1 class="text-2xl font-bold mb-6">Edit <?= $data['tipe'] ?></h1>

<form method="post" class="grid gap-4 max-w-xl bg-white p-6 rounded-xl shadow">
  <input name="nama" class="border p-2 rounded" value="<?= $data['nama'] ?>" required>

  <input name="provinsi" class="border p-2 rounded" value="<?= $data['provinsi'] ?>" required>

  <input name="kabupaten" class="border p-2 rounded" value="<?= $data['kabupaten'] ?>" required>

  <textarea name="alamat" class="border p-2 rounded"><?= $data['alamat'] ?></textarea>

  <input name="latitude" class="border p-2 rounded" value="<?= $data['latitude'] ?>">

  <input name="longitude" class="border p-2 rounded" value="<?= $data['longitude'] ?>">

  <select name="tipe" class="border p-2 rounded">
    <option <?= $data['tipe']=="Masjid"?"selected":"" ?>>Masjid</option>
    <option <?= $data['tipe']=="Mushalla"?"selected":"" ?>>Mushalla</option>
  </select>

  <button class="bg-emerald-600 text-white px-4 py-2 rounded">Update</button>
</form>

<?php include "admin_layout_footer.php"; ?>
