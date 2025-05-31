<?php
include "../koneksi.php";
$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM user WHERE id_user=$id");

echo "<script>alert('Data pengguna berhasil dihapus!'); window.location='data_user.php';</script>";
