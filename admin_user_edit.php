<?php
include "koneksi.php";
include "auth.php";
include "admin_layout_header.php";

$id = $_GET['id'];
$q = mysqli_query($conn, "SELECT * FROM users WHERE id=$id");
$data = mysqli_fetch_assoc($q);

if ($_POST) {
    $username = $_POST['username'];
    $role = $_POST['role'];

    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        mysqli_query($conn, "UPDATE users SET username='$username', password='$password', role='$role' WHERE id=$id");
    } else {
        mysqli_query($conn, "UPDATE users SET username='$username', role='$role' WHERE id=$id");
    }

    header("Location: admin_user.php");
    exit;
}
?>

<h1 class="text-2xl font-bold mb-6">Edit User Admin</h1>

<form method="post" class="grid gap-4 max-w-xl bg-white p-6 rounded-xl shadow">
  <input name="username" class="border p-2 rounded" value="<?= $data['username'] ?>" required>

  <input name="password" class="border p-2 rounded" placeholder="Kosongkan jika tidak ganti password">

  <select name="role" class="border p-2 rounded">
    <option <?= $data['role']=="admin" ? "selected" : "" ?>>admin</option>
    <option <?= $data['role']=="superadmin" ? "selected" : "" ?>>superadmin</option>
  </select>

  <button class="bg-emerald-600 text-white px-4 py-2 rounded">Update</button>
</form>

<?php include "admin_layout_footer.php"; ?>
