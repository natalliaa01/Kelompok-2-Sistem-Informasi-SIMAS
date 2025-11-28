<?php
// admin_layout_header.php
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin – SIMAS</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body { background:#f1f5f9; }
    </style>
</head>

<body class="flex bg-slate-100 text-slate-800">

<!-- SIDEBAR -->
<aside class="w-64 bg-emerald-900 text-white h-screen sticky top-0 flex flex-col">

    <div class="p-4 border-b border-emerald-700 flex items-center gap-3">
        <img src="assets/img/logo-simas.png" class="h-10">
        <div>
            <p class="text-sm font-semibold uppercase">SIMAS</p>
            <p class="text-xs text-emerald-100">Admin Panel</p>
        </div>
    </div>

    <nav class="flex-1 p-4 space-y-1 text-sm">

        <a href="admin_dashboard.php"
           class="block px-3 py-2 rounded hover:bg-emerald-700">Dashboard</a>

        <p class="text-xs text-emerald-200 mt-4 mb-1">Data Sistem</p>

        <a href="admin_info.php"
           class="block px-3 py-2 rounded hover:bg-emerald-700">Info Terkini</a>

        <a href="admin_masjid.php"
           class="block px-3 py-2 rounded hover:bg-emerald-700">Data Masjid</a>

        <a href="admin_mushalla.php"
           class="block px-3 py-2 rounded hover:bg-emerald-700">Data Mushalla</a>

        <p class="text-xs text-emerald-200 mt-4 mb-1">Pengaturan</p>

        <a href="admin_user.php"
           class="block px-3 py-2 rounded hover:bg-emerald-700">Manajemen User</a>

        <a href="logout.php"
           class="block px-3 py-2 rounded bg-red-600 mt-4 text-center">Logout</a>

    </nav>

</aside>

<!-- CONTENT WRAPPER -->
<main class="flex-1 p-8">
