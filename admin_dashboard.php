<?php
include "koneksi.php";
include "auth.php";
include "admin_layout_header.php";

// AMBIL DATA STATISTIK
$total_masjid = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS jml FROM masjid"))['jml'];
$total_mushalla = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS jml FROM masjid WHERE tipe='Mushalla'"))['jml'];
$total_info = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS jml FROM info"))['jml'];

// 5 info terbaru
$info_query = mysqli_query($conn, "SELECT * FROM info ORDER BY tanggal DESC LIMIT 5");
?>

<h1 class="text-2xl font-bold mb-6">Dashboard Admin</h1>

<!-- STATISTIC CARDS -->
<div class="grid md:grid-cols-3 gap-6">

    <!-- MASJID -->
    <div class="bg-white p-6 rounded-xl shadow border-l-4 border-emerald-700">
        <p class="text-sm text-slate-600">Total Masjid</p>
        <p class="text-3xl font-bold text-emerald-700 mt-1"><?= $total_masjid ?></p>
    </div>

    <!-- MUSHALLA -->
    <div class="bg-white p-6 rounded-xl shadow border-l-4 border-amber-500">
        <p class="text-sm text-slate-600">Total Mushalla</p>
        <p class="text-3xl font-bold text-amber-600 mt-1"><?= $total_mushalla ?></p>
    </div>

    <!-- INFO -->
    <div class="bg-white p-6 rounded-xl shadow border-l-4 border-sky-500">
        <p class="text-sm text-slate-600">Info Terkini</p>
        <p class="text-3xl font-bold text-sky-600 mt-1"><?= $total_info ?></p>
    </div>

</div>

<!-- RECENT INFO -->
<div class="bg-white rounded-xl shadow mt-10 overflow-hidden">

    <div class="flex justify-between items-center border-b px-6 py-4 bg-slate-50">
        <h2 class="text-lg font-semibold">Info Terbaru</h2>
        <a href="admin_info.php" class="text-sm text-emerald-700 hover:underline">Lihat Semua</a>

    </div>

    <table class="w-full text-sm">
        <thead class="bg-slate-100 border-b">
            <tr>
                <th class="px-4 py-3 text-left">Judul</th>
                <th class="px-4 py-3 text-left">Tanggal</th>
                <th class="px-4 py-3 text-left">Aksi</th>
            </tr>
        </thead>

        <tbody>
            <?php if (mysqli_num_rows($info_query) > 0): ?>
                <?php while ($info = mysqli_fetch_assoc($info_query)): ?>
                <tr class="border-b hover:bg-slate-50">
                    <td class="px-4 py-3"><?= htmlspecialchars($info['judul']) ?></td>
                    <td class="px-4 py-3"><?= date('d M Y', strtotime($info['tanggal'])) ?></td>
                    <td class="px-4 py-3">
                        <a href="admin_info_edit.php?id=<?= $info['id'] ?>" class="text-emerald-600 hover:underline">Edit</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" class="px-4 py-4 text-center text-slate-500">
                        Belum ada info terbaru.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</div>

<?php include "admin_layout_footer.php"; ?>
