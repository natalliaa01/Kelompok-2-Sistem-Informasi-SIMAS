<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: data.php");
  exit;
}

include "koneksi.php";

$id = $_GET['id'];
$q = mysqli_query($conn, "SELECT * FROM masjid WHERE id='$id'");
$data = mysqli_fetch_assoc($q);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Data Masjid – SIMAS</title>

  <script src="https://cdn.tailwindcss.com"></script>

  <link rel="stylesheet"
    href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>

  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

  <style>
    #map { height: 350px; border-radius: 16px; }
  </style>
</head>

<body class="bg-slate-100">

<div class="max-w-4xl mx-auto px-6 py-10 space-y-6">

  <h1 class="text-2xl font-bold text-slate-700">Edit Data Masjid</h1>

  <form action="update.php" method="POST"
        class="bg-white rounded-2xl shadow p-6 space-y-4">

    <input type="hidden" name="id" value="<?= $data['id']; ?>">

    <div>
      <label class="text-sm font-medium">Nama Masjid</label>
      <input name="nama" required
        value="<?= $data['nama']; ?>"
        class="w-full border rounded-lg px-3 py-2 text-sm">
    </div>

    <div>
      <label class="text-sm font-medium">Provinsi</label>
      <input name="provinsi" required
        value="<?= $data['provinsi']; ?>"
        class="w-full border rounded-lg px-3 py-2 text-sm">
    </div>

    <div>
      <label class="text-sm font-medium">Kabupaten/Kota</label>
      <input name="kabupaten" required
        value="<?= $data['kabupaten']; ?>"
        class="w-full border rounded-lg px-3 py-2 text-sm">
    </div>

    <div>
      <label class="text-sm font-medium">Lokasi Masjid (Geser marker)</label>
      <div id="map"></div>
    </div>

    <div class="grid grid-cols-2 gap-4">
      <div>
        <label class="text-sm font-medium">Latitude</label>
        <input id="lat" name="latitude" readonly
          value="<?= $data['latitude']; ?>"
          class="w-full border rounded-lg px-3 py-2 bg-slate-100 text-sm">
      </div>

      <div>
        <label class="text-sm font-medium">Longitude</label>
        <input id="lng" name="longitude" readonly
          value="<?= $data['longitude']; ?>"
          class="w-full border rounded-lg px-3 py-2 bg-slate-100 text-sm">
      </div>
    </div>

    <button class="px-5 py-2 rounded-lg bg-emerald-700 text-white font-semibold hover:bg-emerald-600">
      Simpan Perubahan
    </button>

  </form>
</div>

<script>
  var lat = <?= $data['latitude'] ?: -2.5 ?>;
  var lng = <?= $data['longitude'] ?: 118 ?>;

  var map = L.map('map').setView([lat, lng], 8);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 18
  }).addTo(map);

  var marker = L.marker([lat, lng], { draggable: true }).addTo(map);

  marker.on('dragend', function(e) {
    var pos = e.target.getLatLng();
    document.getElementById('lat').value = pos.lat.toFixed(6);
    document.getElementById('lng').value = pos.lng.toFixed(6);
  });
</script>

</body>
</html>
