<?php
include "koneksi.php";
include "auth.php";
include "admin_layout_header.php";

// Ambil data masjid
$q = mysqli_query($conn, "SELECT * FROM masjid ORDER BY id DESC");
?>

<h1 class="text-2xl font-bold mb-6">Manajemen Data Masjid</h1>

<a href="admin_masjid_add.php"
   class="bg-emerald-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-emerald-500">
   + Tambah Masjid Baru
</a>

<div class="bg-white rounded-xl shadow mt-6 overflow-hidden">
  <table class="w-full text-sm">
    <thead class="bg-slate-100 border-b">
      <tr>
        <th class="px-4 py-3 text-left">Nama</th>
        <th class="px-4 py-3 text-left">Provinsi</th>
        <th class="px-4 py-3 text-left">Kabupaten</th>
        <th class="px-4 py-3 text-left">Tipe</th>
        <th class="px-4 py-3 text-left">Aksi</th>
      </tr>
    </thead>

    <tbody>
      <?php while ($row = mysqli_fetch_assoc($q)): ?>
      <tr class="border-b hover:bg-slate-50">
        <td class="px-4 py-2"><?= htmlspecialchars($row['nama']) ?></td>
        <td class="px-4 py-2"><?= $row['provinsi'] ?></td>
        <td class="px-4 py-2"><?= $row['kabupaten'] ?></td>
        <td class="px-4 py-2"><?= $row['tipe'] ?></td>
        <td class="px-4 py-2 flex gap-3">
          <a href="admin_masjid_edit.php?id=<?= $row['id'] ?>" class="text-emerald-600 hover:underline">Edit</a>
          <a href="admin_masjid_hapus.php?id=<?= $row['id'] ?>" class="text-red-600 hover:underline"
             onclick="return confirm('Hapus data ini?')">Hapus</a>
        </td>
      </tr>
      <?php endwhile; ?>
    </tbody>

  </table>
</div>

<?php include "admin_layout_footer.php"; ?>
