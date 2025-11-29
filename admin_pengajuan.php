<?php include "auth.php"; 
include "admin_layout_header.php";
include "koneksi.php"; ?>

<h1 class="text-2xl font-bold mb-6">Verifikasi Pengajuan Masyarakat</h1>

<main class="max-w-7xl mx-auto px-6 py-10">

  <div class="bg-white shadow rounded-xl overflow-hidden">
    <table class="w-full text-sm">
      <thead class="bg-slate-100 border-b">
        <tr>
          <th class="px-4 py-3 text-left">Nama</th>
          <th class="px-4 py-3 text-left">Tipe</th>
          <th class="px-4 py-3 text-left">Status</th>
          <th class="px-4 py-3 text-left">Aksi</th>
        </tr>
      </thead>

      <tbody>
      <?php
      $q = mysqli_query($conn, "SELECT * FROM pengajuan ORDER BY dibuat_pada DESC");
      while($r = mysqli_fetch_assoc($q)):
      ?>
        <tr class="border-b hover:bg-slate-50">
          <td class="px-4 py-2"><?= $r['nama'] ?></td>
          <td class="px-4 py-2"><?= ucfirst($r['tipe']) ?></td>
          <td class="px-4 py-2">
            <?php if ($r['status']=='pending'): ?>
              <span class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded text-xs">Pending</span>
            <?php elseif ($r['status']=='disetujui'): ?>
              <span class="bg-green-200 text-green-800 px-2 py-1 rounded text-xs">Disetujui</span>
            <?php else: ?>
              <span class="bg-red-200 text-red-800 px-2 py-1 rounded text-xs">Ditolak</span>
            <?php endif; ?>
          </td>

          <td class="px-4 py-2">
            <a href="admin_pengajuan_detail.php?id=<?= $r['id'] ?>"
              class="text-emerald-700 font-semibold hover:underline">Detail</a>
          </td>
        </tr>
      <?php endwhile; ?>
      </tbody>

    </table>
  </div>

</main>
