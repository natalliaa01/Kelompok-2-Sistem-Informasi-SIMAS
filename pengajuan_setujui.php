<?php
include "koneksi.php";

$id = $_GET['id'];
$d = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM pengajuan WHERE id=$id"));

if ($d['tipe']=='masjid') {
  mysqli_query($conn,
    "INSERT INTO masjid (nama, alamat, kabupaten, provinsi, tipe)
     VALUES ('{$d['nama']}', '{$d['alamat']}', '{$d['kabupaten']}', '{$d['provinsi']}', 'Mushalla')"
  );
}

if ($d['tipe']=='kegiatan') {
  mysqli_query($conn,
    "INSERT INTO info (judul, isi, tanggal)
     VALUES ('{$d['nama']}', '{$d['deskripsi']}', '{$d['tanggal_kegiatan']}')"
  );
}

mysqli_query($conn, "UPDATE pengajuan SET status='disetujui' WHERE id=$id");

header("Location: admin_pengajuan.php");
?>
