<?php include "auth.php"; include "header.php"; include "koneksi.php";

$id = $_GET['id'];
$d = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM pengajuan WHERE id=$id"));
?>

<section class="bg-emerald-800 text-white">
  <div class="max-w-7xl mx-auto px-6 py-8">
    <h1 class="text-2xl font-bold">Detail Pengajuan</h1>
  </div>
</section>

<main class="max-w-3xl mx-auto px-6 py-10">

  <div class="bg-white p-6 rounded-xl shadow space-y-4">

    <h2 class="text-xl font-semibold"><?= $d['nama'] ?></h2>

    <p><span class="font-semibold">Tipe:</span> <?= ucfirst($d['tipe']) ?></p>
    <p><span class="font-semibold">Alamat:</span> <?= $d['alamat'] ?></p>
    <p><span class="font-semibold">Deskripsi:</span> <?= $d['deskripsi'] ?></p>
    <p><span class="font-semibold">Kontak:</span> <?= $d['kontak'] ?></p>

    <?php if ($d['tanggal_kegiatan']): ?>
      <p><span class="font-semibold">Tanggal Kegiatan:</span> <?= $d['tanggal_kegiatan'] ?></p>
    <?php endif; ?>

    <div class="flex gap-4 pt-4">
      <a href="pengajuan_setujui.php?id=<?= $d['id'] ?>"
        class="bg-emerald-600 text-white py-2 px-4 rounded hover:bg-emerald-700">Setujui</a>

      <a href="pengajuan_tolak.php?id=<?= $d['id'] ?>"
        class="bg-red-600 text-white py-2 px-4 rounded hover:bg-red-700"
        onclick="return confirm('Yakin menolak?')">Tolak</a>
    </div>

  </div>

</main>

<?php include "footer.php"; ?>
