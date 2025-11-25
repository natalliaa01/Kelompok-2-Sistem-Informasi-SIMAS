<?php
include "koneksi.php";
include "header.php";
include "auth.php";
?>

<section class="bg-emerald-800 text-white">
  <div class="max-w-7xl mx-auto px-6 py-10">
    <h1 class="text-3xl font-bold">Manajemen Info Terkini</h1>
  </div>
</section>

<main class="max-w-7xl mx-auto px-6 py-10 space-y-6">

  <a href="info_tambah.php"
     class="bg-emerald-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-emerald-500">
     + Tambah Info Baru
  </a>

  <div class="bg-white rounded-2xl shadow overflow-hidden">
    <table class="w-full text-sm">
      <thead class="bg-slate-100 border-b">
        <tr>
          <th class="px-4 py-3 text-left">Judul</th>
          <th class="px-4 py-3 text-left">Tanggal</th>
          <th class="px-4 py-3 text-left">Aksi</th>
        </tr>
      </thead>

      <tbody>
        <?php
        $q = mysqli_query($conn, "SELECT * FROM info ORDER BY tanggal DESC");
        if (mysqli_num_rows($q) > 0):
          while ($row = mysqli_fetch_assoc($q)):
        ?>
          <tr class="border-b hover:bg-slate-50">
            <td class="px-4 py-2"><?= htmlspecialchars($row['judul']) ?></td>
            <td class="px-4 py-2"><?= date('d M Y', strtotime($row['tanggal'])) ?></td>
            <td class="px-4 py-2 flex gap-3">

              <a href="info_edit.php?id=<?= $row['id'] ?>"
                 class="text-emerald-600 font-semibold hover:underline">Edit</a>

              <a href="info_hapus.php?id=<?= $row['id'] ?>"
                 onclick="return confirm('Yakin hapus data?')"
                 class="text-red-600 font-semibold hover:underline">Hapus</a>

            </td>
          </tr>
        <?php endwhile; else: ?>
          <tr>
            <td colspan="3" class="px-4 py-4 text-center text-slate-500">
              Belum ada data info.
            </td>
          </tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

</main>

<?php include "footer.php"; ?>
