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
        <ul class="navbar-nav bg-gradient-custom sidebar sidebar-dark accordion" id="accordionSidebar" style="background: linear-gradient(180deg, #4e73df 10%, #224abe 100%);">
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Keuangan</div>
            </a>

            <hr class="sidebar-divider my-0">

            <li class="nav-item">
                <a class="nav-link" href="">
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

                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="mr-2 d-none d-lg-inline text-gray-600 small">SahrulGunawan</span>
                                    <img class="img-profile rounded-circle"
                                        src="img/ruel.JPG">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                    aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profile
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Settings
                                    </a>
                                    <a class="dropdown-item" href="#">
                                        <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Activity Log
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Logout
                                    </a>
                                </div>
                            </li>
                        </ul>

                </nav>
                <div class="container-fluid">

                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total User Aktif</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $user['total_user'] ?? 0 ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Total Pemasukan</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">Rp <?= number_format($pemasukan['total_pemasukan'] ?? 0, 0, ',', '.') ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total Pengeluaran
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= number_format($pengeluaran['total_pengeluaran'] ?? 0, 0, ',', '.') ?></div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Total Saldo User</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= number_format($saldo['total_saldo'] ?? 0, 0, ',', '.') ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="my-4" />
                        <div class="row g-3">
                            <div class="col-md-6">
                                <h5>Pemasukan Terakhir</h5>
                                <table class="table table-striped">
                                    <thead class="table-dark    ">
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
                    <!-- Logout Confirmation Modal -->
                    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="logoutModalLabel">Konfirmasi Logout</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Tutup">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">Apakah kamu yakin ingin logout dari sistem?</div>
                                <div class="modal-footer">
                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                    <a class="btn btn-primary" href="logout.php">Ya, Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Content Row -->

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