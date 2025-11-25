<?php
include "koneksi.php";

$where = [];

// FILTER PROVINSI
if (!empty($_GET['prov'])) {
  $provKode = $_GET['prov'];
  $provName = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT nama FROM wilayah WHERE kode='$provKode'")
  )['nama'];
  $where[] = "provinsi LIKE '%$provName%'";
}

// FILTER KABUPATEN
if (!empty($_GET['kab'])) {
  $kabKode = $_GET['kab'];
  $kabName = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT nama FROM wilayah WHERE kode='$kabKode'")
  )['nama'];
  $kabClean = preg_replace('/^(Kabupaten|Kota)\s+/i', '', $kabName);
  $where[] = "REPLACE(REPLACE(kabupaten,'Kabupaten ',''),'Kota ','')='$kabClean'";
}

// FILTER KECAMATAN
if (!empty($_GET['kec'])) {
  $kecKode = $_GET['kec'];
  $kecName = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT nama FROM wilayah WHERE kode='$kecKode'")
  )['nama'];
  $where[] = "kecamatan LIKE '%$kecName%'";
}

// FILTER NAMA
if (!empty($_GET['cari'])) {
  $q = $_GET['cari'];
  $where[] = "nama LIKE '%$q%'";
}

$whereSql = !empty($where) ? "WHERE ".implode(" AND ", $where) : "";

$result = mysqli_query($conn,
  "SELECT * FROM masjid $whereSql ORDER BY id DESC"
);
?>


<h2 class="text-xl font-semibold mb-5">Hasil Pencarian</h2>

<?php if (mysqli_num_rows($result) > 0): ?>
  <div class="space-y-4">
    <?php while($m = mysqli_fetch_assoc($result)): ?>
      <div class="bg-white shadow rounded-xl p-4 flex items-center gap-4">
        <img src="assets/img/masjid.jpg" class="w-20 h-20 rounded" alt="">
        <div class="flex-1">
          <p class="font-bold"><?= $m['nama'] ?></p>
          <p class="text-sm text-slate-600">
            <?= $m['alamat'] ?>,
            <?= $m['kabupaten'] ?>,
            <?= $m['provinsi'] ?>
          </p>
        </div>
        <a href="detail.php?id=<?= $m['id'] ?>"
           class="px-3 py-1 bg-emerald-600 text-white rounded text-xs">
          Lihat Detail
        </a>
      </div>
    <?php endwhile; ?>
  </div>

<?php else: ?>
  <p class="text-slate-500">Tidak ada data ditemukan.</p>
<?php endif; ?>
