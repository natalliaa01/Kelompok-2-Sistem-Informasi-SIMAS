<?php
include "koneksi.php";
include "header.php";
include "auth.php";

$id = $_GET['id'];
$q = mysqli_query($conn, "SELECT * FROM info WHERE id=$id");
$data = mysqli_fetch_assoc($q);

if ($_POST) {
  $judul = $_POST['judul'];
  $isi = $_POST['isi'];
  $tanggal = $_POST['tanggal'];

  mysqli_query($conn,
    "UPDATE info SET judul='$judul', isi='$isi', tanggal='$tanggal'
     WHERE id=$id"
  );

  header("Location: admin_info.php");
  exit;
}
?>

<section class="bg-emerald-800 text-white">
  <div class="max-w-7xl mx-auto px-6 py-10">
    <h1 class="text-3xl font-bold">Edit Info</h1>
  </div>
</section>

<main class="max-w-3xl mx-auto px-6 py-10">

  <form method="POST" class="bg-white rounded-2xl shadow p-6 space-y-4">

    <div>
      <label class="text-sm font-medium">Judul</label>
      <input name="judul" value="<?= htmlspecialchars($data['judul']) ?>"
        class="w-full border rounded-lg px-3 py-2 text-sm">
    </div>

    <div>
      <label class="text-sm font-medium">Tanggal</label>
      <input type="date" name="tanggal"
        value="<?= $data['tanggal'] ?>"
        class="w-full border rounded-lg px-3 py-2 text-sm">
    </div>

    <div>
      <label class="text-sm font-medium">Isi Informasi</label>
      <textarea name="isi" rows="6"
        class="w-full border rounded-lg px-3 py-2 text-sm"><?= htmlspecialchars($data['isi']) ?></textarea>
    </div>

    <button class="bg-emerald-600 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-emerald-500">
      Update
    </button>

  </form>

</main>

<?php include "footer.php"; ?>
