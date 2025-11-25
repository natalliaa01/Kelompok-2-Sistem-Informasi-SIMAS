<?php
include "koneksi.php";

$id = $_GET['id'] ?? 0;

$q = mysqli_query($conn, "SELECT * FROM info WHERE id=$id");
$data = mysqli_fetch_assoc($q);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title><?= $data['judul'] ?> – SIMAS</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100 text-slate-800">

<?php include "header.php"; ?>

<section class="max-w-7xl mx-auto px-6 py-10">

  <p class="text-xs text-slate-500 mb-2">
    <?= date("d M Y", strtotime($data['tanggal'])) ?>
  </p>

  <h1 class="text-3xl font-bold text-emerald-800 mb-4">
    <?= htmlspecialchars($data['judul']) ?>
  </h1>

  <?php if (!empty($data['gambar'])): ?>
    <img src="uploads/<?= $data['gambar'] ?>" class="rounded-xl mb-6 w-full max-h-96 object-cover">
  <?php endif; ?>

  <p class="text-slate-700 leading-relaxed text-sm">
    <?= nl2br($data['isi']) ?>
  </p>

</section>

<?php include "footer.php"; ?>

</body>
</html>
