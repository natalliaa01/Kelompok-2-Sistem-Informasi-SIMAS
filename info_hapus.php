<?php
include "koneksi.php";
include "auth.php";

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM info WHERE id=$id");

header("Location: admin_info.php");
exit;
?>
