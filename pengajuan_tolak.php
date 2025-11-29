<?php
include "koneksi.php";

if (!isset($_GET['id'])) {
    die("ID tidak ditemukan.");
}

$id = intval($_GET['id']); // keamanan

mysqli_query($conn, "UPDATE pengajuan SET status='Ditolak' WHERE id=$id");

echo "<script>alert('Pengajuan ditolak!'); window.location='admin_pengajuan.php';</script>";
?>
