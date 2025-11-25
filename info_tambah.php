<?php
include "koneksi.php";
include "header.php";
include "auth.php";

if ($_POST) {
  $judul = $_POST['judul'];
  $isi = $_POST['isi'];
  $tanggal = $_POST['tanggal'];

  mysqli_query($conn,
    "INSERT INTO info (judul, isi, tanggal)
     VALUES ('$judul', '$isi', '$tanggal')"
  );

  header("Location: admin_info.php");
  exit;
}
?>

<section class="bg-emerald-800 text-white">
  <div class="max-w-7xl mx-auto px-6 py-10">
    <h1 class="text-3xl font-bold">Tambah Info Baru</h1>
  </div>
</section>

<main class="max-w-3xl mx-auto px-6 py-10">

  <form method="POST" class="bg-white rounded-2xl shadow p-6 space-y-4">

    <div>
      <label class="text-sm font-medium">Judul</label>
      <input name="judul" required
        class="w-full border rounded-lg px-3 py-2 text-sm">
    </div>

    <div>
      <label class="text-sm font-medium">Tanggal</label>
      <input type="date" name="tanggal" required
        class="w-full border rounded-lg px-3 py-2 text-sm">
    </div>

    <div>
      <label class="text-sm font-medium">Isi Informasi</label>
      <textarea name="isi" rows="6" required
        class="w-full border rounded-lg px-3 py-2 text-sm"></textarea>
    </div>

    <button class="bg-emerald-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-emerald-500">
      Simpan
    </button>

  </form>
</main>

<?php include "footer.php"; ?>
