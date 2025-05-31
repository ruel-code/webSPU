<?php
include "../koneksi.php";

if (isset($_POST['simpan'])) {
    $id_user   = $_POST['id_user'];
    $tanggal   = $_POST['tanggal'];
    $jumlah    = $_POST['jumlah'];
    $keterangan = $_POST['keterangan'];

    $query = "INSERT INTO pemasukan (id_user, tanggal, jumlah, keterangan) 
              VALUES ('$id_user', '$tanggal', '$jumlah', '$keterangan')";
    mysqli_query($koneksi, $query);

    // Simpan pemasukan
    $query = "INSERT INTO pemasukan (id_user, tanggal, jumlah, keterangan)
              VALUES ('$id_user', '$tanggal', '$jumlah', '$keterangan')";
    $simpan = mysqli_query($koneksi, $query);

    // Update saldo user
    if ($simpan) {
        $updateSaldo = "UPDATE user SET saldo = saldo + $jumlah WHERE id_user = '$id_user'";
        mysqli_query($koneksi, $updateSaldo);

        echo "<script>alert('Pemasukan berhasil ditambahkan!'); window.location='data_pemasukan.php';</script>";
    } else {
        echo "<script>alert('Gagal menyimpan pemasukan');</script>";
    }
    echo "<script>alert('Data pemasukan berhasil ditambahkan!'); window.location='data_pemasukan.php';</script>";
}

$user_query = mysqli_query($koneksi, "SELECT id_user, nama_lengkap FROM user ORDER BY nama_lengkap");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Keuangan</title>
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="../css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-custom sidebar sidebar-dark accordion" id="accordionSidebar" style="background: linear-gradient(to right,rgb(49, 53, 54),rgb(8, 62, 74));">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Keuangan</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link" href="index.html">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Master Data
            </div>
            <li class="nav-item">
                <a class="nav-link" href="../admin/data_admin.php">
                    <i class="fas fa-user-cog"></i>
                    <span>Data Admin</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="user/data_user.php">
                    <i class="fas fa-user"></i>
                    <span>Data User</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Transaksi
            </div>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-arrow-down"></i>
                    <span>Pemasukan</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-arrow-up"></i>
                    <span>Pengeluaran</span>
                </a>
            </li>
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Laporan
            </div>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fa-file-alt"></i>
                    <span>Laporan</span>
                </a>
            </li>
            <hr class="sidebar-divider d-none d-md-block">

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <h2>Sistem Pengelolaan Uang</h1>

                </nav>
                <div class="container-fluid">
                    <h3>Tambah Data Pemasukan</h3>
                    <form method="POST" action="">
                        <div class="form-group">
                            <label>User</label>
                            <select name="id_user" class="form-control" required>
                                <option value="">-- Pilih User --</option>
                                <?php
                                while ($user = mysqli_fetch_assoc($user_query)) {
                                    echo "<option value='{$user['id_user']}'>{$user['nama_lengkap']}</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Tanggal</label>
                            <input type="date" name="tanggal" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Jumlah</label>
                            <input type="number" name="jumlah" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Keterangan</label>
                            <textarea name="keterangan" class="form-control"></textarea>
                        </div>
                        <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                        <a href="data_pemasukan.php" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>