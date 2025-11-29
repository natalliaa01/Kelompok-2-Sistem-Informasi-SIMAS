<?php
include "header.php";
include "koneksi.php";

/* ====== CEK KOLOM KECAMATAN ====== */
$cekKec = mysqli_query($conn, "SHOW COLUMNS FROM masjid LIKE 'kecamatan'");
$hasKecamatan = mysqli_num_rows($cekKec) > 0;

/* ====== BUILD FILTER QUERY ====== */
$where = [];

// PROVINSI
if (!empty($_GET['prov'])) {
  $provKode = $_GET['prov'];
  $provRow = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT nama FROM wilayah WHERE kode='$provKode'")
  );
  if ($provRow) {
    $provName = $provRow['nama'];
    $where[] = "provinsi LIKE '%$provName%'";
  }
}

// KABUPATEN
if (!empty($_GET['kab'])) {
  $kabKode = $_GET['kab'];
  $kabRow = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT nama FROM wilayah WHERE kode='$kabKode'")
  );
  if ($kabRow) {
    $kabName = $kabRow['nama'];
    $kabClean = preg_replace('/^(Kabupaten|Kota)\s+/i', '', $kabName);
    $where[] = "REPLACE(REPLACE(kabupaten,'Kabupaten ',''),'Kota ','') = '$kabClean'";
  }
}

// KECAMATAN
if ($hasKecamatan && !empty($_GET['kec'])) {
  $kecKode = $_GET['kec'];
  $kecRow = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT nama FROM wilayah WHERE kode='$kecKode'")
  );
  if ($kecRow) {
    $kecName = $kecRow['nama'];
    $kecClean = preg_replace('/^(Kecamatan)\s+/i', '', $kecName);
    $where[] = "REPLACE(kecamatan,'Kecamatan ','') = '$kecClean'";
  }
}

// SEARCH NAME
if (!empty($_GET['cari'])) {
  $cari = $_GET['cari'];
  $where[] = "nama LIKE '%$cari%'";
}

// Gabungkan WHERE
$whereSql = "";
if (!empty($where)) {
  $whereSql = "WHERE " . implode(" AND ", $where);
}

// QUERY DATA
$hasil = mysqli_query($conn,
  "SELECT * FROM masjid $whereSql ORDER BY id DESC LIMIT 100"
);

?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= htmlspecialchars($pageTitle) ?></title>

  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    body {
      background: #f3f4f6;
    }
    /* scrollbar halus untuk list update */
    .nice-scroll::-webkit-scrollbar {
      width: 6px;
    }
    .nice-scroll::-webkit-scrollbar-thumb {
      background: rgba(15, 118, 110, 0.6);
      border-radius: 999px;
    }
  </style>
</head>

<body class="text-slate-800">

<!-- HERO KECIL -->
<section class="bg-emerald-800 text-white">
  <div class="max-w-7xl mx-auto px-6 py-10 space-y-2">
    <h1 class="text-3xl font-bold">Data Masjid/Mushalla
    <p class="text-sm max-w-2xl text-emerald-100">
      Detail informasi terkait alamat masjid/mushalla di Indonesia.
    </p>
  </div>
</section>

<body class="bg-slate-100 text-slate-800">

<div class="max-w-6xl mx-auto px-6 py-10">

  <h1 class="text-2xl font-bold mb-6">Hasil Pencarian Masjid & Mushalla</h1>

  <a href="index.php"
     class="inline-block mb-6 px-4 py-2 bg-slate-300 rounded-lg text-sm font-semibold hover:bg-slate-400">
    Kembali ke Beranda
  </a>

  <?php if ($hasil && mysqli_num_rows($hasil) > 0): ?>

    <div class="space-y-4">
      <?php while ($m = mysqli_fetch_assoc($hasil)): ?>
        <div class="bg-white rounded-xl shadow p-4 flex gap-4 items-center">

          <img src="assets/img/masjid.jpg" class="w-20 h-20 rounded object-cover" alt="">

          <div class="flex-1">
            <p class="font-semibold text-slate-800 text-sm">
              <?= htmlspecialchars($m['nama']) ?>
            </p>

            <p class="text-xs text-slate-600 mt-1">
              <?= htmlspecialchars($m['alamat'] ?? '') ?>
              <?php if ($hasKecamatan && $m['kecamatan']): ?>
                , <?= htmlspecialchars($m['kecamatan']) ?>
              <?php endif; ?>
              , <?= htmlspecialchars($m['kabupaten']) ?>,
              <?= htmlspecialchars($m['provinsi']) ?>
            </p>
          </div>

          <a href="detail.php?id=<?= $m['id'] ?>"
             class="px-3 py-1 bg-emerald-600 text-white text-xs rounded-lg">
            Lihat Detail
          </a>
        </div>
      <?php endwhile; ?>
    </div>

  <?php else: ?>
    <p class="text-slate-500 text-sm">Tidak ada data ditemukan.</p>
  <?php endif; ?>

</div>

<?php include "footer.php"; ?>
</body>
</html>
