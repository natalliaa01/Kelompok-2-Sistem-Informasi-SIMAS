<?php
include "koneksi.php";
include "auth.php";

$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM users WHERE id=$id");

header("Location: admin_user.php");
exit;
