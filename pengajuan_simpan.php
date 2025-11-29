<?php
include "koneksi.php";

$tipe = $_POST['tipe'];
$nama = $_POST['nama'];
$alamat = $_POST['alamat'];
$deskripsi = $_POST['deskripsi'];
$kab = $_POST['kabupaten'];
$prov = $_POST['provinsi'];
$kontak = $_POST['kontak'];

if (!empty($_POST['tanggal_kegiatan'])) {
    $tgl = "'" . $_POST['tanggal_kegiatan'] . "'";  // diberi kutip
} else {
    $tgl = "NULL"; // TANPA kutip
}

$sql = "
INSERT INTO pengajuan (tipe, nama, alamat, deskripsi, kabupaten, provinsi, kontak, tanggal_kegiatan)
VALUES ('$tipe', '$nama', '$alamat', '$deskripsi', '$kab', '$prov', '$kontak', $tgl)
";

mysqli_query($conn, $sql);

echo "<script>
alert('Pengajuan berhasil dikirim! Menunggu verifikasi admin.');
window.location='index.php';
</script>";

?>
