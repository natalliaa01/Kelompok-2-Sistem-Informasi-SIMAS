<?php
include "koneksi.php";
include "auth.php";
include "admin_layout_header.php";
?>

<h1 class="text-2xl font-bold mb-6">Manajemen Info Terkini</h1>

<a href="admin_info_add.php"
   class="bg-emerald-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-emerald-500">
   + Tambah Info Baru
</a>

<div class="bg-white mt-6 rounded-xl shadow overflow-hidden">
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
                <td class="px-4 py-3"><?= htmlspecialchars($row['judul']) ?></td>
                <td class="px-4 py-3"><?= date('d M Y', strtotime($row['tanggal'])) ?></td>
                <td class="px-4 py-3 flex gap-4">
                    <a href="admin_info_edit.php?id=<?= $row['id'] ?>"
                       class="text-emerald-600 font-semibold hover:underline">Edit</a>
                    <a href="admin_info_hapus.php?id=<?= $row['id'] ?>"
                       onclick="return confirm('Hapus data ini?')"
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

<?php include "admin_layout_footer.php"; ?>
