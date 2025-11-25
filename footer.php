<footer class="bg-emerald-900 text-emerald-100 pt-14 pb-8 mt-16">
  <div class="max-w-7xl mx-auto px-6 grid gap-12 md:grid-cols-3">

    <!-- TENTANG -->
    <div>
      <h3 class="text-lg font-semibold mb-4 text-white">Tentang Kami</h3>
      <p class="text-sm leading-relaxed text-emerald-200">
        SIMAS adalah sistem informasi resmi Kementerian Agama Republik Indonesia
        yang menyajikan data masjid dan mushalla di seluruh wilayah Indonesia.
      </p>

      <img src="assets/img/logo-simas.png"
           class="h-20 mt-6 opacity-95"
           alt="SIMAS Logo">
    </div>

    <!-- ALAMAT -->
    <div>
      <h3 class="text-lg font-semibold mb-4 text-white">Alamat Kami</h3>

      <p class="text-sm text-emerald-200 mb-3">
        Direktorat Jenderal Bimbingan Masyarakat Islam<br>
        Gedung Kementerian Agama RI Lt.6<br>
        Jl. M. H. Thamrin No. 6, Jakarta 10340
      </p>

      <p class="text-sm text-emerald-300 mb-2">📞 (0221) 3812871</p>
      <p class="text-sm text-emerald-300 mb-2">
        📱 (0221) 31924509 – 3193056 – 3920774
      </p>
      <p class="text-sm text-emerald-300 mb-2">✉️ kemasjidan@kemenag.go.id</p>
      <p class="text-sm text-emerald-300">PO.BOX 3733 JKP 10037</p>
    </div>

    <!-- PETA SITUS -->
    <div>
      <h3 class="text-lg font-semibold mb-4 text-white">Peta Situs</h3>

      <ul class="space-y-3 text-sm">
        <li><a href="unduh.php" class="hover:text-amber-300 transition">Unduh Data</a></li>
        <li><a href="data.php" class="hover:text-amber-300 transition">Profil Masjid</a></li>
        <li><a href="data.php?tipe=Mushalla" class="hover:text-amber-300 transition">Profil Mushalla</a></li>
        <li><a href="info.php" class="hover:text-amber-300 transition">Info Terkini</a></li>
        <li><a href="kontak.php" class="hover:text-amber-300 transition">Kontak Kami</a></li>
      </ul>
    </div>

  </div>

  <!-- COPYRIGHT -->
  <div class="border-t border-emerald-800 mt-12 pt-6 text-center text-xs text-emerald-300">
    Copyright ©<?= date('Y') ?> SIMAS – Kementerian Agama RI. All rights reserved.
  </div>
</footer>
