<?php include "header.php"; ?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Kontak Kami – SIMAS</title>

  <!-- Tailwind -->
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    body { background:#f3f4f6; }
  </style>
</head>
<body class="text-slate-800">

<!-- HERO -->
<section class="bg-emerald-800 text-white">
  <div class="max-w-7xl mx-auto px-6 py-10 space-y-2">
    <h1 class="text-3xl font-bold">Kontak Kami</h1>
    <p class="text-sm max-w-2xl text-emerald-100">
      Hubungi kami untuk pertanyaan, saran, maupun informasi terkait layanan SIMAS.
    </p>
  </div>
</section>

<!-- CONTENT -->
<main class="max-w-7xl mx-auto px-6 py-12 grid gap-10 lg:grid-cols-2">

  <!-- FORM -->
  <section class="bg-white rounded-2xl shadow-sm p-6 space-y-4">
    <h2 class="text-lg font-semibold text-slate-700 mb-2">Kirim Pesan</h2>

    <form action="#" method="post" class="space-y-4">
      <div>
        <label class="text-sm font-medium">Nama Lengkap</label>
        <input type="text" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm" placeholder="Masukkan nama anda">
      </div>

      <div>
        <label class="text-sm font-medium">Email</label>
        <input type="email" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm" placeholder="email@example.com">
      </div>

      <div>
        <label class="text-sm font-medium">Subjek</label>
        <input type="text" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm" placeholder="Judul pesan">
      </div>

      <div>
        <label class="text-sm font-medium">Pesan</label>
        <textarea rows="4" class="w-full border border-slate-300 rounded-lg px-3 py-2 text-sm" placeholder="Tulis pesan anda di sini"></textarea>
      </div>

      <button class="px-5 py-2 rounded-lg bg-amber-400 text-amber-900 text-sm font-semibold hover:bg-amber-300">
        Kirim Pesan
      </button>
    </form>
  </section>

  <!-- INFO + MAP -->
  <section class="space-y-5">

    <div class="bg-white rounded-2xl shadow-sm p-6 space-y-3">
      <h2 class="text-lg font-semibold text-slate-700 mb-1">Alamat Kantor</h2>
      <p class="text-sm text-slate-600 leading-relaxed">
        Direktorat Jenderal Bimbingan Masyarakat Islam<br>
        Kementerian Agama Republik Indonesia<br>
        Jl. M. H. Thamrin No. 6, Jakarta 10340
      </p>

      <p class="text-sm text-slate-600 mt-3">
        Email: <span class="font-medium text-emerald-700">kemasjidan@kemenag.go.id</span><br>
        Telepon: (021) 3811654
      </p>
    </div>

    <!-- MAP PLACEHOLDER -->
    <iframe
    class="w-full h-64 rounded-2xl shadow-sm"
    style="border:0;"
    loading="lazy"
    allowfullscreen
    referrerpolicy="no-referrer-when-downgrade"
    src="https://www.google.com/maps?q=-6.184202315008112,106.82295132008738&hl=id&z=17&output=embed">
    </iframe>




  </section>
</main>
<?php include "footer.php"; ?>
</body>
</html>
