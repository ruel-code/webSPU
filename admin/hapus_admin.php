<?php
include "../koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Jalankan query hapus
    $query = "DELETE FROM admin WHERE id_admin = '$id'";
    $result = mysqli_query($koneksi, $query);

    if ($result) {
        echo "<script>alert('Data berhasil dihapus'); window.location='data_admin.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus data'); window.location='data_admin.php';</script>";
    }
} else {
    echo "<script>alert('ID tidak ditemukan'); window.location='data_admin.php';</script>";
}
?>
