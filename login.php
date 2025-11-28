<?php
session_start();
include "koneksi.php";

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $pass = $_POST['password'];

    $q = mysqli_query($conn, "SELECT * FROM users WHERE username='$user'");
    $data = mysqli_fetch_assoc($q);

    if ($data) {
        if ($data && $pass === $data['password']) {

            $_SESSION['login'] = true;
            $_SESSION['username'] = $data['username'];
            $_SESSION['role'] = $data['role'];

            header("Location: admin_dashboard.php");
            exit;

        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Username tidak ditemukan!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-emerald-900">

<div class="flex items-center justify-center h-screen">
  <form method="post" class="bg-white p-8 rounded-xl shadow-lg w-80 space-y-4">

    <h2 class="text-xl font-bold text-center text-slate-700">Login Admin</h2>

    <?php if ($error): ?>
      <p class="text-red-600 text-sm bg-red-100 p-2 rounded"><?= $error ?></p>
    <?php endif; ?>

    <input name="username" class="w-full border p-2 rounded" placeholder="Username" required>
    <input type="password" name="password" class="w-full border p-2 rounded" placeholder="Password" required>

    <button class="bg-emerald-600 text-white w-full py-2 rounded hover:bg-emerald-700">
      Login
    </button>

  </form>
</div>

</body>
</html>
