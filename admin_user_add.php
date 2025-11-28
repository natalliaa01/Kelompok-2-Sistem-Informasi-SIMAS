<?php
include "koneksi.php";
include "auth.php";
include "admin_layout_header.php";

if ($_POST) {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    mysqli_query($conn, "INSERT INTO users (username, password, role)
                         VALUES ('$username', '$password', '$role')");

    header("Location: admin_user.php");
    exit;
}
?>

<h1 class="text-2xl font-bold mb-6">Tambah User Admin</h1>

<form method="post" class="grid gap-4 max-w-xl bg-white p-6 rounded-xl shadow">
  <input name="username" class="border p-2 rounded" placeholder="Username" required>
  <input name="password" class="border p-2 rounded" placeholder="Password" required>
  <select name="role" class="border p-2 rounded">
    <option value="admin">Admin</option>
    <option value="superadmin">Superadmin</option>
  </select>

  <button class="bg-emerald-600 text-white px-4 py-2 rounded">Simpan</button>
</form>

<?php include "admin_layout_footer.php"; ?>
