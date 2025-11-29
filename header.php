<?php
if (!isset($pageTitle)) {
  $pageTitle = "SIMAS – Sistem Informasi Masjid";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body { background:#f3f4f6; }
  </style>
</head>

<body class="text-slate-800">

<!-- NAVBAR -->
<header class="bg-emerald-900 text-white shadow w-full sticky top-0 z-50">

  <div class="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">

    <!-- LOGO -->
    <div class="flex items-center gap-3">
      <img src="assets/img/logo-simas.png" class="h-12" alt="Logo SIMAS">
      <div class="leading-tight hidden md:block">
        <p class="text-sm font-semibold uppercase">SIMAS</p>
        <p class="text-xs text-emerald-100">Sistem Informasi Masjid</p>
      </div>
    </div>

    <!-- HAMBURGER -->
    <button id="menuBtn"
      class="md:hidden text-white hover:text-amber-300 transition">
      <svg xmlns="http://www.w3.org/2000/svg"
           class="w-9 h-9 p-1 border-2 border-amber-300 rounded-lg"
           fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round"
              stroke-width="2"
              d="M4 6h16M4 12h16M4 18h16" />
      </svg>
    </button>

    <!-- MENU DESKTOP -->
    <nav class="hidden md:flex gap-10 text-sm font-medium">

      <a href="index.php"
        class="<?= basename($_SERVER['PHP_SELF'])=='index.php' ? 'text-amber-300 font-bold' : 'hover:text-amber-300' ?>">
        Beranda
      </a>

      <a href="data.php"
        class="<?= basename($_SERVER['PHP_SELF'])=='data.php' ? 'text-amber-300 font-bold' : 'hover:text-amber-300' ?>">
        Data Masjid/Mushalla
      </a>

      <a href="pengajuan_form.php"
        class="<?= basename($_SERVER['PHP_SELF'])=='pengajuan_form.php' ? 'text-amber-300 font-bold' : 'hover:text-amber-300' ?>">
        Form Pengajuan
      </a>

      <a href="info.php"
        class="<?= basename($_SERVER['PHP_SELF'])=='info.php' ? 'text-amber-300 font-bold' : 'hover:text-amber-300' ?>">
        Info Terkini
      </a>

      <a href="kontak.php"
        class="<?= basename($_SERVER['PHP_SELF'])=='kontak.php' ? 'text-amber-300 font-bold' : 'hover:text-amber-300' ?>">
        Kontak Kami
      </a>

    </nav>

  </div>

  <!-- MENU MOBILE (FULL GREEN BLOCK) -->
  <nav id="mobileMenu"
       class="hidden flex-col md:hidden bg-emerald-800 border-t border-emerald-700">

    <a href="index.php"
       class="px-6 py-4 border-b border-emerald-700 block
              <?= basename($_SERVER['PHP_SELF'])=='index.php' ? 'text-amber-300 font-bold' : '' ?>">
       Beranda
    </a>

    <a href="data.php"
       class="px-6 py-4 border-b border-emerald-700 block
              <?= basename($_SERVER['PHP_SELF'])=='data.php' ? 'text-amber-300 font-bold' : '' ?>">
       Data Masjid/Mushalla
    </a>

    <a href="pengajuan_form.php"
       class="px-6 py-4 border-b border-emerald-700 block
              <?= basename($_SERVER['PHP_SELF'])=='pengajuan_form.php' ? 'text-amber-300 font-bold' : '' ?>">
       Form Pengajuan
    </a>

    <a href="info.php"
       class="px-6 py-4 border-b border-emerald-700 block
              <?= basename($_SERVER['PHP_SELF'])=='info.php' ? 'text-amber-300 font-bold' : '' ?>">
       Info Terkini
    </a>

    <a href="kontak.php"
       class="px-6 py-4 block
              <?= basename($_SERVER['PHP_SELF'])=='kontak.php' ? 'text-amber-300 font-bold' : '' ?>">
       Kontak Kami
    </a>

  </nav>

</header>

<script>
document.getElementById("menuBtn").addEventListener("click", () => {
  document.getElementById("mobileMenu").classList.toggle("hidden");
});
</script>

