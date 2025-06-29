<?php
require_once 'koneksi.php';

if (isset($_POST['username'])) {
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    $hash = password_hash($password, PASSWORD_DEFAULT);

    // Siapkan statement
    $stmt = $koneksi->prepare("INSERT INTO pengguna (nama, username, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nama, $username, $hash);

    if ($stmt->execute()) {
        echo "<script>alert('Registrasi berhasil!'); window.location.href = 'login.php';</script>";
    } else {
        echo "<script>alert('Gagal: " . $stmt->error . "');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Daftar</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'/>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
    <form action="" method="post" class="login-form">
        <h1 class="login-title">Register</h1>

        <div class="input-box">
            <i class='bx bxs-user'></i>
            <input type="text" name="nama" placeholder="Nama Lengkap" required />
        </div>
        <div class="input-box">
            <i class='bx bxs-user'></i>
            <input type="text" name="username" placeholder="Username" required />
        </div>
        <div class="input-box">
            <i class='bx bxs-lock-alt'></i>
            <input type="password" name="password" placeholder="Password" required />
        </div>

        <button type="submit" class="login-btn">Daftar</button>

        <p class="register">
            Sudah punya akun?
            <a href="login.php">Login</a>
        </p>
    </form>
</body>
</html>
