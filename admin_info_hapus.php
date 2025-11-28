<?php
include "koneksi.php";
include "auth.php";

$id = intval($_GET['id']);

$q = mysqli_query($conn, "SELECT gambar FROM info WHERE id=$id");
$d = mysqli_fetch_assoc($q);

if ($d && $d['gambar'] && file_exists("uploads/" . $d['gambar'])) {
    unlink("uploads/" . $d['gambar']);
}

mysqli_query($conn, "DELETE FROM info WHERE id=$id");
header("Location: admin_info.php");
exit;
?>
