<?php
include "koneksi.php";

$where = [];

// FILTER PROVINSI
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

// FILTER KABUPATEN
if (!empty($_GET['kab'])) {
  $kabKode = $_GET['kab'];
  $kabRow = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT nama FROM wilayah WHERE kode='$kabKode'")
  );
  if ($kabRow) {
    $kabName = preg_replace('/^(Kabupaten|Kota)\s+/i', '', $kabRow['nama']);
    $where[] = "REPLACE(REPLACE(kabupaten,'Kabupaten ',''),'Kota ','') = '$kabName'";
  }
}

// FILTER NAMA MASJID
if (!empty($_GET['cari'])) {
  $cari = $_GET['cari'];
  $where[] = "nama LIKE '%$cari%'";
}

// build final WHERE
$whereSql = "";
if (!empty($where)) {
  $whereSql = "WHERE " . implode(" AND ", $where);
}

$result = mysqli_query($conn,
  "SELECT * FROM masjid $whereSql ORDER BY nama ASC"
);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Data Masjid & Mushalla – SIMAS</title>

  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100 text-slate-800">

<!-- NAVBAR -->
<header class="bg-emerald-900 text-white">
  <div class="max-w-7xl mx-auto px-6 py-3 flex items-center justify-between">
    <div class="flex items-center gap-3">
      <img src="assets/img/logo-simas.png" class="h-10" alt="Logo SIMAS">
      <div>
        <p class="text-sm font-semibold uppercase">SIMAS</p>
        <p class="text-xs text-emerald-100">Sistem Informasi Masjid</p>
      </div>
    </div>

    <nav class="hidden md:flex gap-6 text-sm font-medium">
      <a href="index.php" class="hover:text-amber-300">Beranda</a>
      <a href="data.php" class="text-amber-300 font-semibold">Data Masjid/Mushalla</a>
      <a href="info.php" class="hover:text-amber-300">Info Terkini</a>
      <a href="kontak.php" class="hover:text-amber-300">Kontak Kami</a>
    </nav>
  </div>
</header>

<!-- HERO -->
<section class="bg-emerald-800 text-white">
  <div class="max-w-7xl mx-auto px-6 py-10 space-y-2">
    <h1 class="text-3xl font-bold">Data Masjid & Mushalla</h1>
    <p class="text-sm max-w-2xl text-emerald-100">
      Daftar masjid dan mushalla terdaftar dalam sistem SIMAS seluruh Indonesia.
    </p>
  </div>
</section>

<!-- CONTENT -->
<main class="max-w-7xl mx-auto px-6 py-10 space-y-8">

  <!-- FILTER UI -->
  <form method="GET" action="data.php"
        class="bg-white rounded-2xl shadow p-4 grid gap-3 md:grid-cols-4">

    <!-- PROV -->
    <select name="prov" id="provinsi"
      class="border border-slate-300 rounded-lg px-3 py-2 text-sm">
      <option value="">Pilih Provinsi</option>
      <?php
      $prov = mysqli_query($conn,
        "SELECT kode, nama FROM wilayah WHERE CHAR_LENGTH(kode)=2 ORDER BY nama"
      );
      while ($p = mysqli_fetch_assoc($prov)):
      ?>
        <option value="<?= $p['kode'] ?>"
          <?= (isset($_GET['prov']) && $_GET['prov']==$p['kode']) ? 'selected' : '' ?>>
          <?= $p['nama'] ?>
        </option>
      <?php endwhile; ?>
    </select>

    <!-- KAB -->
    <select name="kab" id="kabupaten"
      class="border border-slate-300 rounded-lg px-3 py-2 text-sm">
      <option value="">Pilih Kabupaten/Kota</option>
    </select>

    <!-- SEARCH -->
    <input name="cari"
      value="<?= $_GET['cari'] ?? '' ?>"
      class="border border-slate-300 rounded-lg px-3 py-2 text-sm"
      placeholder="Cari nama masjid..." />

    <button class="px-4 py-2 rounded-lg bg-amber-400 text-amber-900 text-sm font-semibold hover:bg-amber-300">
      Cari
    </button>
  </form>

  <!-- TABEL DATA -->
  <section class="bg-white rounded-2xl shadow overflow-hidden">
    <table class="w-full text-sm">
      <thead class="bg-emerald-800 text-white text-xs uppercase">
        <tr>
          <th class="px-4 py-2 text-left">Nama</th>
          <th class="px-4 py-2 text-left">Provinsi</th>
          <th class="px-4 py-2 text-left">Kabupaten</th>
          <th class="px-4 py-2 text-left">Tipologi</th>
        </tr>
      </thead>

      <tbody>
        <?php if ($result && mysqli_num_rows($result) > 0): ?>
          <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <tr class="border-b hover:bg-slate-50">
              <td class="px-4 py-2"><?= htmlspecialchars($row['nama']) ?></td>
              <td class="px-4 py-2"><?= htmlspecialchars($row['provinsi']) ?></td>
              <td class="px-4 py-2"><?= htmlspecialchars($row['kabupaten']) ?></td>
              <td class="px-4 py-2"><?= htmlspecialchars($row['tipologi']) ?></td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr>
            <td colspan="4" class="px-4 py-4 text-center text-slate-500">
              Tidak ada data ditemukan.
            </td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </section>

</main>

<!-- AJAX KABUPATEN -->
<script>
  const prov = document.getElementById('provinsi');
  const kab  = document.getElementById('kabupaten');

  function loadKabupaten(selectedKab = '') {
    if (!prov.value) {
      kab.innerHTML = '<option value="">Pilih Kabupaten/Kota</option>';
      return;
    }
    fetch('get_kabupaten.php?prov=' + prov.value)
      .then(r => r.text())
      .then(html => {
        kab.innerHTML = html;
        if (selectedKab) kab.value = selectedKab;
      });
  }

  prov.addEventListener('change', () => loadKabupaten(''));

  const initialKab = "<?= $_GET['kab'] ?? '' ?>";
  if (prov.value !== "") loadKabupaten(initialKab);
</script>
<?php include "footer.php"; ?>
</body>
</html>
