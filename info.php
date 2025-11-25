<?php
include "koneksi.php";

$q = mysqli_query($conn, "SELECT * FROM info ORDER BY tanggal DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Info Terkini – SIMAS</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100 text-slate-800">

<?php include "header.php"; ?>
<!-- HERO -->
<section class="bg-emerald-800 text-white">
  <div class="max-w-7xl mx-auto px-6 py-10 space-y-2">
    <h1 class="text-3xl font-bold">Info Terkini
    <p class="text-sm max-w-2xl text-emerald-100">
      Dapatkan informasi ter-update di sini!
    </p>
  </div>
</section>
<section class="max-w-7xl mx-auto px-6 py-10">
  <div class="space-y-4">
    <?php while($row = mysqli_fetch_assoc($q)): ?>
      <a href="detail_info.php?id=<?= $row['id'] ?>"
        class="block bg-white p-5 rounded-xl shadow hover:bg-slate-50">
        <p class="text-xs text-slate-500 mb-1">
          <?= date("d M Y", strtotime($row['tanggal'])) ?>
        </p>
        <h2 class="text-lg font-semibold text-emerald-700">
          <?= htmlspecialchars($row['judul']) ?>
        </h2>
      </a>
    <?php endwhile; ?>
  </div>
</section>


<?php include "footer.php"; ?>

</body>
</html>
