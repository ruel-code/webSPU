<?php
include "../koneksi.php";

$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM pengeluaran WHERE id_pengeluaran = $id"));
$jumlah = $data['jumlah'];
$id_user = $data['id_user'];

// Hapus dan kembalikan saldo
mysqli_query($koneksi, "DELETE FROM pengeluaran WHERE id_pengeluaran = $id");
mysqli_query($koneksi, "UPDATE user SET saldo = saldo + $jumlah WHERE id_user = $id_user");

echo "<script>alert('Data berhasil dihapus!'); window.location='data_pengeluaran.php';</script>";
?>
