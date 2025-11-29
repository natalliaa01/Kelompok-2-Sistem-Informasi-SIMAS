<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pengajuan Masyarakat – SIMAS</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100 text-slate-800">

<!-- HEADER -->
<?php include "header.php"; ?>

<!-- HERO -->
<section class="bg-emerald-800 text-white">
  <div class="max-w-7xl mx-auto px-6 py-10">
    <h1 class="text-3xl font-bold">Pengajuan Masjid & Kegiatan</h1>
    <p class="text-sm text-emerald-100 mt-2">
      Ajukan masjid/mushalla baru atau kegiatan keagamaan untuk diverifikasi oleh admin SIMAS.
    </p>
  </div>
</section>

<!-- FORM -->
<main class="max-w-3xl mx-auto px-6 py-10">
  <div class="bg-white shadow-lg rounded-2xl p-6 space-y-6">

    <h2 class="text-xl font-semibold text-slate-700">Form Pengajuan</h2>

    <form action="pengajuan_simpan.php" method="post" class="space-y-5">

      <div>
        <label class="text-sm font-medium">Jenis Pengajuan</label>
        <select name="tipe" class="w-full border rounded-lg px-3 py-2 mt-1" required>
          <option value="">-- Pilih --</option>
          <option value="masjid">Masjid / Mushalla Baru</option>
          <option value="kegiatan">Kegiatan Keagamaan</option>
        </select>
      </div>

      <div>
        <label class="text-sm font-medium">Nama Masjid / Nama Kegiatan</label>
        <input name="nama" class="w-full border rounded-lg px-3 py-2 mt-1" required>
      </div>

      <div>
        <label class="text-sm font-medium">Alamat Lengkap</label>
        <textarea name="alamat" class="w-full border rounded-lg px-3 py-2 mt-1"></textarea>
      </div>

      <div>
        <label class="text-sm font-medium">Deskripsi</label>
        <textarea name="deskripsi" class="w-full border rounded-lg px-3 py-2 mt-1"></textarea>
      </div>

      <div class="grid grid-cols-2 gap-4">
        <div>
          <label class="text-sm font-medium">Provinsi</label>
          <input name="provinsi" class="w-full border rounded-lg px-3 py-2 mt-1">
        </div>
        <div>
          <label class="text-sm font-medium">Kabupaten / Kota</label>
          <input name="kabupaten" class="w-full border rounded-lg px-3 py-2 mt-1">
        </div>
      </div>

      <div>
        <label class="text-sm font-medium">Kontak Pengaju</label>
        <input name="kontak" class="w-full border rounded-lg px-3 py-2 mt-1">
      </div>

      <div>
        <label class="text-sm font-medium">Tanggal Kegiatan (Jika Kegiatan)</label>
        <input type="date" name="tanggal_kegiatan"
               class="w-full border rounded-lg px-3 py-2 mt-1">
      </div>

      <button class="w-full bg-emerald-700 text-white py-2 rounded-lg font-semibold hover:bg-emerald-600">
        Kirim Pengajuan
      </button>

    </form>
  </div>
</main>

<?php include "footer.php"; ?>

</body>
</html>
