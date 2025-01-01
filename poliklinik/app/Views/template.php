<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Poliklinik</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('adminlte/plugins/fontawesome-free/css/all.min.css') ?>">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?= base_url('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
  <link rel="stylesheet" href="<?= base_url('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('adminlte/dist/css/adminlte.min.css') ?>">
</head>

<body class="dark-mode hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="<?= base_url('logo-white.png') ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-dark">Poliklinik</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <?php if (session()->get('role') == 'admin') : ?>
              <li class="nav-item">
                <a href="<?= base_url('/') ?>" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('/dokter') ?>" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    Dokter
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('/pasien') ?>" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    Pasien
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('/obat') ?>" class="nav-link">
                  <i class="nav-icon fas fa-plus-circle"></i>
                  <p>
                    Obat
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('/poli') ?>" class="nav-link">
                  <i class="nav-icon fas fa-plus-circle"></i>
                  <p>
                    Poli
                  </p>
                </a>
              </li>
            <?php endif ?>
            <?php if (session()->get('role') == 'dokter') : ?>
              <!-- Add links for dokter role here -->
              <li class="nav-item">
                <a href="<?= base_url('/dokter/profile') ?>" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    Profile
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('/dokter/editData') ?>" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    Ubah Data
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('/dokter/jadwalPeriksa') ?>" class="nav-link">
                  <i class="nav-icon fas fa-check-square"></i>
                  <p>
                    Jadwal Periksa
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('/dokter/daftarPeriksa') ?>" class="nav-link">
                  <i class="nav-icon fas fa-check-square"></i>
                  <p>
                    Periksa Pasien
                  </p>
                </a>
              </li><li class="nav-item">
                <a href="<?= base_url('/dokter/riwayatPeriksa') ?>" class="nav-link">
                  <i class="nav-icon fas fa-check-square"></i>
                  <p>
                    Riwayat Periksa Pasien
                  </p>
                </a>
              </li>
            <?php endif ?>
            <?php if (session()->get('role') == 'pasien') : ?>
              <!-- Add links for pasien role here -->
              <li class="nav-item">
                <a href="<?= base_url('/pasien/profile') ?>" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    Profile
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('/pasien/editData') ?>" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>
                    Ubah Data
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="<?= base_url('/pasien/daftarPoli') ?>" class="nav-link">
                  <i class="nav-icon fas fa-heartbeat"></i>
                  <p>
                    Daftar Poli
                  </p>
                </a>
              </li>
            <?php endif ?>
            <li class="nav-item">
              <a href="<?= base_url('/logout') ?>" class="nav-link">
                <i class="nav-icon fas fa-sign-out-alt"></i>
                <p>
                  Logout
                </p>
              </a>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <?= $this->renderSection('content') ?>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0
      </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="<?= base_url('adminlte/plugins/jquery/jquery.min.js') ?>"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <!-- DataTables  & Plugins -->
  <script src="<?= base_url('adminlte/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
  <script src="<?= base_url('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
  <script src="<?= base_url('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
  <script src="<?= base_url('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>
  <script src="<?= base_url('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') ?>"></script>
  <script src="<?= base_url('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') ?>"></script>
  <script src="<?= base_url('adminlte/plugins/jszip/jszip.min.js') ?>"></script>
  <script src="<?= base_url('adminlte/plugins/pdfmake/pdfmake.min.js') ?>"></script>
  <script src="<?= base_url('adminlte/plugins/pdfmake/vfs_fonts.js') ?>"></script>
  <script src="<?= base_url('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') ?>"></script>
  <script src="<?= base_url('adminlte/plugins/datatables-buttons/js/buttons.print.min.js') ?>"></script>
  <script src="<?= base_url('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js') ?>"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url('adminlte/dist/js/adminlte.js') ?>"></script>
  <?= $this->renderSection('script') ?>
</body>

</html>