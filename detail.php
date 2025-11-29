<?php
include "header.php";
include "koneksi.php";

// CEK ID ADA APA NGGAK
if (!isset($_GET['id']) || empty($_GET['id'])) {
  die("ID tidak valid.");
}

$id = intval($_GET['id']);

// AMBIL DATA MASJID BERDASARKAN ID
$q = mysqli_query($conn, "SELECT * FROM masjid WHERE id = $id");
$m = mysqli_fetch_assoc($q);

// KALAU DATA NGGAK ADA
if (!$m) {
  die("Data masjid tidak ditemukan.");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($m['nama']) ?> - Detail Masjid</title>

  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet"
    href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"/>
</head>

<body class="bg-slate-100 text-slate-800">


<!-- HERO KECIL -->
<section class="bg-emerald-800 text-white">
  <div class="max-w-7xl mx-auto px-6 py-10 space-y-2">
    <h1 class="text-3xl font-bold">Detail Masjid/Mushalla
    <p class="text-sm max-w-2xl text-emerald-100">
      Detail informasi terkait detail masjid/mushalla di Indonesia.
    </p>
  </div>
</section>

<!-- CONTENT -->
<div class="max-w-5xl mx-auto p-6 space-y-6">

  <div class="bg-white shadow rounded-xl p-6">
    <h2 class="text-2xl font-bold text-emerald-700 mb-3">
      <?= htmlspecialchars($m['nama']) ?>
    </h2>

    <p class="text-sm text-slate-600 mb-1">
      <strong>Alamat:</strong> <?= htmlspecialchars($m['alamat'] ?? '-') ?>
    </p>

    <p class="text-sm text-slate-600 mb-1">
      <strong>Kabupaten:</strong> <?= htmlspecialchars($m['kabupaten']) ?>
    </p>

    <p class="text-sm text-slate-600 mb-1">
      <strong>Provinsi:</strong> <?= htmlspecialchars($m['provinsi']) ?>
    </p>

    <?php if (!empty($m['kecamatan'])): ?>
      <p class="text-sm text-slate-600 mb-1">
        <strong>Kecamatan:</strong> <?= htmlspecialchars($m['kecamatan']) ?>
      </p>
    <?php endif; ?>
  </div>

  <!-- MAP -->
  <?php if (!empty($m['latitude']) && !empty($m['longitude'])): ?>
    <div>
      <h3 class="text-lg font-semibold mb-2">Lokasi di Peta</h3>
      <div id="map" class="w-full h-80 rounded-xl shadow"></div>
    </div>
  <?php endif; ?>

  <!-- BUTTON BACK -->
  <a href="index.php"
     class="inline-block px-4 py-2 bg-amber-400 rounded-lg font-semibold text-amber-900 hover:bg-amber-300">
    Kembali
  </a>

</div>

<!-- LEAFLET -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<?php if (!empty($m['latitude']) && !empty($m['longitude'])): ?>
<script>
  var map = L.map('map').setView([<?= $m['latitude'] ?>, <?= $m['longitude'] ?>], 15);
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19
  }).addTo(map);

  L.marker([<?= $m['latitude'] ?>, <?= $m['longitude'] ?>])
    .addTo(map)
    .bindPopup("<?= htmlspecialchars($m['nama'], ENT_QUOTES) ?>");
</script>
<?php endif; ?>
<?php include "footer.php"; ?>
</body>
</html>
