<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: data.php");
  exit;
}

include "koneksi.php";

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM masjid WHERE id='$id'");

header("Location: data.php");
exit;
