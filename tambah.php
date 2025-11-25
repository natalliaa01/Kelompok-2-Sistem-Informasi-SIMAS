<?php include "koneksi.php"; ?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tambah Data Masjid – SIMAS</title>

  <!-- Tailwind -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- LEAFLET CSS -->
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

  <!-- LEAFLET JS -->
  <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

  <style>
    #map { height: 350px; }
  </style>
</head>

<body class="bg-slate-100 text-slate-800">

<!-- NAVBAR -->
<header class="bg-emerald-900 text-white">
  <div class="max-w-7xl mx-auto px-6 py-3 flex items-center justify-between">
    <div class="flex items-center gap-3">
      <img src="assets/img/logo-simas.png" class="h-10">
      <div>
        <p class="text-sm font-semibold uppercase">SIMAS</p>
        <p class="text-xs text-emerald-100">Sistem Informasi Masjid</p>
      </div>
    </div>

    <nav class="hidden md:flex gap-6 text-sm font-medium">
      <a href="index.php" class="hover:text-amber-300">Beranda</a>
      <a href="data.php" class="hover:text-amber-300">Data Masjid/Mushalla</a>
      <a href="tambah.php" class="text-amber-300 font-semibold">Tambah Data</a>
    </nav>
  </div>
</header>

<!-- CONTENT -->
<div class="max-w-7xl mx-auto px-6 py-10 space-y-6">

  <h1 class="text-2xl font-bold text-slate-700">Tambah Data Masjid</h1>

  <!-- FORM -->
  <form action="simpan.php" method="POST" class="bg-white rounded-2xl shadow p-6 space-y-4">

    <div>
      <label class="text-sm font-medium">Nama Masjid</label>
      <input name="nama" required class="w-full border rounded-lg px-3 py-2 text-sm">
    </div>

    <div>
      <label class="text-sm font-medium">Provinsi</label>
      <input name="provinsi" required class="w-full border rounded-lg px-3 py-2 text-sm">
    </div>

    <div>
      <label class="text-sm font-medium">Kabupaten/Kota</label>
      <input name="kabupaten" required class="w-full border rounded-lg px-3 py-2 text-sm">
    </div>

    <!-- MAP PICKER -->
    <div>
      <label class="text-sm font-medium">Lokasi Masjid (Klik pada peta)</label>
      <div id="map" class="rounded-xl shadow"></div>
    </div>

    <div class="grid grid-cols-2 gap-4">
      <div>
        <label class="text-sm font-medium">Latitude</label>
        <input id="lat" name="latitude" readonly class="w-full border rounded-lg px-3 py-2 bg-slate-100 text-sm">
      </div>
      <div>
        <label class="text-sm font-medium">Longitude</label>
        <input id="lng" name="longitude" readonly class="w-full border rounded-lg px-3 py-2 bg-slate-100 text-sm">
      </div>
    </div>

    <button class="px-5 py-2 rounded-lg bg-emerald-700 text-white font-semibold hover:bg-emerald-600">
      Simpan Data
    </button>
  </form>
</div>

<script>
  // Inisialisasi map
  var map = L.map('map').setView([-2.5, 118], 5);

  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 18
  }).addTo(map);

  var marker;

  // Klik peta → koordinat masuk otomatis
  map.on('click', function(e) {
    var lat = e.latlng.lat.toFixed(6);
    var lng = e.latlng.lng.toFixed(6);

    document.getElementById('lat').value = lat;
    document.getElementById('lng').value = lng;

    // Hapus marker sebelumnya
    if (marker) {
      map.removeLayer(marker);
    }

    // Tambah marker baru
    marker = L.marker([lat, lng]).addTo(map);
  });
</script>

</body>
</html>
