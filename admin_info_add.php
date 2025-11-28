<?php
include "koneksi.php";
include "auth.php";

$uploadDir = "uploads/";
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if ($_POST) {
  $judul = mysqli_real_escape_string($conn, $_POST['judul']);
  $isi = mysqli_real_escape_string($conn, $_POST['isi']);
  $tanggal = $_POST['tanggal'];

  $filename = null;

  if (!empty($_FILES['gambar']['name'])) {
    $original = basename($_FILES['gambar']['name']);
    $safeName = time() . "_" . preg_replace('/[^A-Za-z0-9.\-_]/', '_', $original);

    if (move_uploaded_file($_FILES['gambar']['tmp_name'], $uploadDir . $safeName)) {
        $filename = $safeName;
    }
  }

  mysqli_query($conn,
    "INSERT INTO info (judul, isi, tanggal, gambar)
     VALUES ('$judul', '$isi', '$tanggal', '$filename')"
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

<h2 class="text-xl font-semibold mb-4">Tambah Info Terkini</h2>

<form method="post" enctype="multipart/form-data" class="space-y-3 bg-white p-6 rounded shadow">

  <input name="judul" placeholder="Judul" class="w-full border p-2 rounded" required>

  <textarea name="isi" rows="5" placeholder="Isi berita"
    class="w-full border p-2 rounded" required></textarea>

  <input type="date" name="tanggal" class="border p-2 rounded" required>

  <input type="file" name="gambar" class="border p-2 rounded">

  <button class="bg-emerald-600 text-white px-4 py-2 rounded">Simpan</button>
</form>

</body>
</html>
