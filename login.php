<?php
session_start();
include "koneksi.php";

if ($_POST) {
  $user = $_POST['username'];
  $pass = md5($_POST['password']);

  $q = mysqli_query($conn,
    "SELECT * FROM admin WHERE username='$user' AND password='$pass'"
  );

  if (mysqli_num_rows($q) == 1) {
    $_SESSION['admin_login'] = $user;
    header("Location: admin_dashboard.php");
    exit;
  } else {
    $error = "Username atau password salah!";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-100 flex items-center justify-center h-screen">

  <form method="POST"
    class="bg-white p-6 rounded-2xl shadow-md w-80 space-y-4">

    <h2 class="text-center text-lg font-semibold text-slate-700">
      Login Admin SIMAS
    </h2>

    <?php if (!empty($error)): ?>
      <p class="text-red-600 text-sm"><?= $error ?></p>
    <?php endif; ?>

    <input name="username" placeholder="Username"
      class="w-full border px-3 py-2 rounded-lg text-sm" required>

    <input type="password" name="password" placeholder="Password"
      class="w-full border px-3 py-2 rounded-lg text-sm" required>

    <button class="w-full bg-emerald-600 text-white py-2 rounded-lg font-semibold">
      Login
    </button>

  </form>

</body>
</html>
