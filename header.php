<?php
// Kalau $pageTitle belum di-set, pakai default
if (!isset($pageTitle)) {
  $pageTitle = "SIMAS – Sistem Informasi Masjid";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?= htmlspecialchars($pageTitle) ?></title>

  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    body {
      background: #f3f4f6;
    }
    /* scrollbar halus untuk list update */
    .nice-scroll::-webkit-scrollbar {
      width: 6px;
    }
    .nice-scroll::-webkit-scrollbar-thumb {
      background: rgba(15, 118, 110, 0.6);
      border-radius: 999px;
    }
  </style>
</head>
<body class="text-slate-800">

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
      <a href="index.php" class="<?= basename($_SERVER['PHP_SELF'])=='index.php' ? 'text-amber-300 font-semibold' : 'hover:text-amber-300' ?>">Beranda</a>

      <a href="data.php" class="<?= basename($_SERVER['PHP_SELF'])=='data.php' ? 'text-amber-300 font-semibold' : 'hover:text-amber-300' ?>">Data Masjid/Mushalla</a>

      <a href="info.php" class="<?= basename($_SERVER['PHP_SELF'])=='info.php' ? 'text-amber-300 font-semibold' : 'hover:text-amber-300' ?>">Info Terkini</a>

      <a href="kontak.php" class="<?= basename($_SERVER['PHP_SELF'])=='kontak.php' ? 'text-amber-300 font-semibold' : 'hover:text-amber-300' ?>">Kontak Kami</a>
    </nav>
  </div>
</header>


