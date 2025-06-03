<?php
include "../koneksi.php";

$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM pemasukan WHERE id_pemasukan = '$id'");

echo "<script>alert('Data berhasil dihapus!'); window.location='data_pemasukan.php';</script>";
?>




