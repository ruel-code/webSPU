<?php
include "koneksi.php";
$user = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total_user FROM user WHERE status='aktif'"));
$pemasukan = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(jumlah) AS total_pemasukan FROM pemasukan"));
$pengeluaran = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(jumlah) AS total_pengeluaran FROM pengeluaran"));
$saldo = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(saldo) AS total_saldo FROM user WHERE status='aktif'"));
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
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

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
                <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Master Data
            </div>
            <li class="nav-item">
                <a class="nav-link" href="admin/data_admin.php">
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
            <hr class="sidebar-divider">
            <div class="sidebar-heading">
                Transaksi
            </div>
            <li class="nav-item">
                <a class="nav-link" href="pemasukan/data_pemasukan.php">
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

                    <div class="container mt-4">
                        <div class="row g-3">
                            <div class="col-md-3">
                                <div class="card bg-primary text-white h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">Total User Aktif</h5>
                                        <p class="card-text fs-3"><?= $user['total_user'] ?? 0 ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-success text-white h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">Total Pemasukan</h5>
                                        <p class="card-text fs-3">Rp <?= number_format($pemasukan['total_pemasukan'] ?? 0, 0, ',', '.') ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-danger text-white h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">Total Pengeluaran</h5>
                                        <p class="card-text fs-3">Rp <?= number_format($pengeluaran['total_pengeluaran'] ?? 0, 0, ',', '.') ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card bg-info text-white h-100">
                                    <div class="card-body">
                                        <h5 class="card-title">Total Saldo User</h5>
                                        <p class="card-text fs-3">Rp <?= number_format($saldo['total_saldo'] ?? 0, 0, ',', '.') ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr class="my-4" />
                        <div class="row g-3">
                            <div class="col-md-6">
                                <h5>Pemasukan Terakhir</h5>
                                <table class="table table-striped">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>User</th>
                                            <th>Tanggal</th>
                                            <th>Jumlah</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $query = mysqli_query($koneksi, "SELECT p.*, u.nama_lengkap FROM pemasukan p JOIN user u ON p.id_user=u.id_user ORDER BY p.tanggal DESC LIMIT 5");
                                        while ($row = mysqli_fetch_assoc($query)) {
                                            echo "<tr>
                                                      <td>{$no}</td>
                                                      <td>{$row['nama_lengkap']}</td>
                                                      <td>{$row['tanggal']}</td>
                                                      <td>Rp " . number_format($row['jumlah'], 0, ',', '.') . "</td>
                                                      <td>{$row['keterangan']}</td>
                                                  </tr>";
                                            $no++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h5>Pengeluaran Terakhir</h5>
                                <table class="table table-striped">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>No</th>
                                            <th>User</th>
                                            <th>Tanggal</th>
                                            <th>Jumlah</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $query = mysqli_query($koneksi, "SELECT p.*, u.nama_lengkap FROM pengeluaran p JOIN user u ON p.id_user=u.id_user ORDER BY p.tanggal DESC LIMIT 5");
                                        while ($row = mysqli_fetch_assoc($query)) {
                                            echo "<tr>
                                                   <td>{$no}</td>
                                                      <td>{$row['nama_lengkap']}</td>
                                                      <td>{$row['tanggal']}</td>
                                                      <td>Rp " . number_format($row['jumlah'], 0, ',', '.') . "</td>
                                                      <td>{$row['keterangan']}</td>
                                                  </tr>";
                                            $no++;
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    </div>
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