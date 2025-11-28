<?php
include "koneksi.php";
include "auth.php";

$id = intval($_GET['id']);
$q = mysqli_query($conn, "SELECT * FROM info WHERE id=$id");
$data = mysqli_fetch_assoc($q);

$uploadDir = "uploads/";
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if ($_POST) {
  $judul = mysqli_real_escape_string($conn, $_POST['judul']);
  $isi = mysqli_real_escape_string($conn, $_POST['isi']);
  $tanggal = $_POST['tanggal'];

  $filename = $data['gambar'];

  if (!empty($_FILES['gambar']['name'])) {
    $original = basename($_FILES['gambar']['name']);
    $safeName = time() . "_" . preg_replace('/[^A-Za-z0-9.\-_]/', '_', $original);

    if (move_uploaded_file($_FILES['gambar']['tmp_name'], $uploadDir . $safeName)) {
        $filename = $safeName;
    }
  }

  mysqli_query($conn,
    "UPDATE info SET
      judul='$judul',
      isi='$isi',
      tanggal='$tanggal',
      gambar='$filename'
     WHERE id=$id"
  );

  header("Location: admin_info.php");
  exit;
}
?>
<!DOCTYPE html>
<html>
<head>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100 p-6">

<h2 class="text-xl font-semibold mb-4">Edit Info</h2>

<form method="post" enctype="multipart/form-data" class="space-y-3 bg-white p-6 rounded shadow">

  <input name="judul" value="<?= $data['judul'] ?>" class="w-full border p-2 rounded" required>

  <textarea name="isi" rows="5" class="w-full border p-2 rounded" required><?= $data['isi'] ?></textarea>

  <input type="date" name="tanggal" value="<?= $data['tanggal'] ?>"
         class="border p-2 rounded" required>

  <?php if ($data['gambar']): ?>
    <img src="uploads/<?= $data['gambar'] ?>" class="w-40 rounded mb-2">
  <?php endif; ?>

  <input type="file" name="gambar" class="border p-2 rounded">

  <button class="bg-emerald-600 text-white px-4 py-2 rounded">Update</button>
</form>

</body>
</html>
