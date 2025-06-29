<?php
require_once 'koneksi.php';
session_start();

$error = "";

if (isset($_POST['username'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $stmt = $koneksi->prepare("SELECT id, nama, password FROM pengguna WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Verifikasi password
    if (password_verify($password, $user['password'])) {
      $_SESSION['login'] = true;
      $_SESSION['nama'] = $user['nama'];
      $_SESSION['username'] = $username;

      header("Location: index.php");
      exit();
    } else {
      $error = "Password salah.";
    }
  } else {
    $error = "Username tidak ditemukan.";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="css/style.css">
</head>

<body>

  <form action="" method="post">
    <h1 class="login-title">Login</h1>

    <?php if ($error): ?>
      <div style="color: red; margin-bottom: 10px;"><?= $error ?></div>
    <?php endif; ?>

    <div class="input-box">
      <i class='bx bxs-user'></i>
      <input type="text" name="username" placeholder="Username" required>
    </div>
    <div class="input-box">
      <i class='bx bxs-lock-alt'></i>
      <input type="password" name="password" placeholder="Password" required>
    </div>

    <div class="remember-forgot-box">
      <label for="remember">
        <input type="checkbox" id="remember">
        Remember me
      </label>
    </div>

    <button type="submit" class="login-btn">Login</button>

    <p class="register">
      Belum punya akun?
      <a href="daftar_user.php">Daftar</a>
    </p>
  </form>

</body>

</html>
