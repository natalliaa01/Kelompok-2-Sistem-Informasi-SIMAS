<?php
include "header.php";
include "koneksi.php";

/* ====== CEK APAKAH KOLOM KECAMATAN ADA ====== */
$cekKec = mysqli_query($conn, "SHOW COLUMNS FROM masjid LIKE 'kecamatan'");
$hasKecamatan = mysqli_num_rows($cekKec) > 0;

/* ====== HITUNG TOTAL MASJID ====== */
$totalMasjidRow = mysqli_fetch_assoc(
  mysqli_query($conn, "SELECT COUNT(*) AS jml FROM masjid")
);
$totalMasjid = $totalMasjidRow ? $totalMasjidRow['jml'] : 0;
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SIMAS – Sistem Informasi Masjid</title>

  <!-- TAILWIND -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- LEAFLET CSS -->
  <link rel="stylesheet"
    href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
    crossorigin=""/>

  <style>
    #map {
      height: 480px;
      border-radius: 18px;
    }
    .custom-select {
      width: 100%;
      border: 1px solid #d1d5db;
      background-color: #ffffff;
      color: #1e293b;
      border-radius: 8px;
      padding: 8px 12px;
      font-size: 14px;
      appearance: none;
    }
    .select-arrow {
      position: absolute;
      right: 12px;
      top: 12px;
      font-size: 10px;
      color: #64748b;
      pointer-events: none;
    }
  </style>
</head>

<body class="bg-slate-100 text-slate-800">

<!-- HERO -->
<section class="relative bg-emerald-800 text-white">
  <div class="absolute inset-0 opacity-35 bg-cover bg-center"
       style="background-image:url('assets/img/bg-masjid.jpg')"></div>

  <div class="relative max-w-7xl mx-auto px-6 py-16 space-y-4">
    <h1 class="text-4xl font-bold">Cek Profil Masjid & Mushalla</h1>
    <p class="text-sm max-w-xl opacity-90">
      Akses data masjid dan mushalla secara resmi dari Kementerian Agama Republik Indonesia.
    </p>
  </div>

  <!-- FILTER BAR -->
  <div class="relative max-w-7xl mx-auto px-6 pb-10">
    <form method="GET" action="filter.php">
      <div class="bg-white rounded-2xl shadow-lg p-4 grid gap-3 md:grid-cols-5">

        <!-- PROVINSI -->
        <div class="relative">
          <select id="provinsi" name="prov" class="custom-select">
            <option value="">Pilih Provinsi</option>
            <?php
            $prov = mysqli_query($conn,
              "SELECT kode, nama FROM wilayah WHERE CHAR_LENGTH(kode)=2 ORDER BY nama"
            );
            while ($p = mysqli_fetch_assoc($prov)):
            ?>
              <option value="<?= $p['kode'] ?>">
                <?= $p['nama'] ?>
              </option>
            <?php endwhile; ?>
          </select>
          <span class="select-arrow">▼</span>
        </div>

        <!-- KABUPATEN -->
        <div class="relative">
          <select id="kabupaten" name="kab" class="custom-select">
            <option value="">Pilih Kabupaten/Kota</option>
          </select>
          <span class="select-arrow">▼</span>
        </div>

        <!-- KECAMATAN -->
        <div class="relative">
          <select id="kecamatan" name="kec" class="custom-select">
            <option value="">Pilih Kecamatan</option>
          </select>
          <span class="select-arrow">▼</span>
        </div>

        <input name="cari"
          class="border border-slate-200 rounded-lg px-3 py-2 text-sm"
          placeholder="Ketik nama masjid">

        <button class="px-4 bg-amber-400 rounded-lg font-semibold text-amber-900 hover:bg-amber-300">
          CARI
        </button>
      </div>
    </form>
  </div>
</section>

<!-- STATISTIK -->
<section class="max-w-7xl mx-auto px-6 py-12 space-y-10">
  <div class="grid gap-6 md:grid-cols-3">
    <div class="bg-white rounded-2xl shadow-md p-6 text-center">
      <p class="text-xs text-slate-500">Total Masjid Terdaftar</p>
      <p class="text-3xl font-bold text-emerald-700">
        <?= number_format($totalMasjid) ?>
      </p>
    </div>
  </div>

  <h2 class="text-lg font-semibold text-slate-700 mb-4">Peta Sebaran Masjid</h2>

  <div class="flex gap-6">
    <!-- SIDEBAR FILTER -->
    <div class="w-64 bg-white shadow-md rounded-xl p-4 h-fit">
      <p class="text-sm font-semibold mb-3">Filter Peta</p>

      <label class="text-xs text-slate-600">Tipe</label>
      <select id="filterTipe" class="w-full border rounded-lg px-3 py-2 text-sm mb-4">
        <option value="">Semua</option>
        <option value="Masjid">Masjid</option>
        <option value="Mushalla">Mushalla</option>
      </select>

      <button id="btnApplyMap"
        class="w-full bg-emerald-600 text-white py-2 rounded-lg text-sm font-semibold hover:bg-emerald-500">
        Terapkan Filter
      </button>

      <button id="btnResetMap"
        class="w-full bg-slate-200 text-slate-700 mt-2 py-2 rounded-lg text-sm font-semibold hover:bg-slate-300">
        Reset
      </button>
    </div>

    <!-- MAP -->
    <div class="flex-1">
      <div id="map" class="w-full h-[480px] rounded-xl shadow"></div>
    </div>
  </div>
</section>

<!-- LEAFLET JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

<script>
var map = L.map('map').setView([-2.5, 118], 5);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
  maxZoom: 18
}).addTo(map);

let markersLayer = L.layerGroup().addTo(map);

function loadMarkers(tipe = "") {
  markersLayer.clearLayers();

  fetch('get_map_data.php?tipe=' + encodeURIComponent(tipe))
    .then(r => r.json())
    .then(data => {
      data.forEach(item => {
        L.marker([item.latitude, item.longitude])
          .addTo(markersLayer)
          .bindPopup(`<b>${item.nama}</b><br>${item.kabupaten}, ${item.provinsi}<br><i>${item.tipe}</i>`);
      });
    });
}

// FIRST LOAD
loadMarkers();

// APPLY FILTER
document.getElementById('btnApplyMap').addEventListener('click', () => {
  const tipe = document.getElementById('filterTipe').value;
  loadMarkers(tipe);
});

// RESET
document.getElementById('btnResetMap').addEventListener('click', () => {
  document.getElementById('filterTipe').value = "";
  loadMarkers("");
});
</script>

<!-- AJAX CASCADE -->
<script>
const prov = document.getElementById('provinsi');
const kab  = document.getElementById('kabupaten');
const kec  = document.getElementById('kecamatan');

prov.addEventListener('change', () => {
  fetch('get_kabupaten.php?prov=' + prov.value)
    .then(r => r.text())
    .then(html => {
      kab.innerHTML = html;
      kec.innerHTML = '<option value="">Pilih Kecamatan</option>';
    });
});

kab.addEventListener('change', () => {
  fetch('get_kecamatan.php?kab=' + kab.value)
    .then(r => r.text())
    .then(html => {
      kec.innerHTML = html;
    });
});
</script>
<?php include "footer.php"; ?>
</body>
</html>
