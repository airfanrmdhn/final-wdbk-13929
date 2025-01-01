<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Pendaftaran Berhasil</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('adminlte/plugins/fontawesome-free/css/all.min.css') ?>">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('adminlte/dist/css/adminlte.min.css') ?>">
  <style>
    .login-box {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      width: 400px;
    }
  </style>
</head>

<body class="hold-transition">
  <div class="login-box">
    <div class="card card-outline card-primary">
      <div class="card-body">
        <p class="login-box-msg">Pendaftaran Berhasil!</p>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          Selamat, Anda telah berhasil mendaftar!
        </div>
        <h5>Informasi Pendaftaran</h5>
        <table class="table table-striped">
          <tr>
            <th>Nama</th>
            <td><?= $nama ?></td>
          </tr>
          <tr>
            <th>Alamat</th>
            <td><?= $alamat ?></td>
          </tr>
          <tr>
            <th>No KTP</th>
            <td><?= $no_ktp ?></td>
          </tr>
          <tr>
            <th>No HP</th>
            <td><?= $no_hp ?></td>
          </tr>
          <tr>
            <th>No Rekam Medis</th>
            <td><?= $no_rm ?></td>
          </tr>
          <tr>
            <th>Username Login</th>
            <td><?= $username ?></td>
          </tr>
          <tr>
            <th>Password Default</th>
            <td><?= $password ?></td>
          </tr>
        </table>
        <p class="mt-3 mb-1">
          <a href="<?php echo base_url('login') ?>">Masuk Sekarang</a>
        </p>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery -->
  <script src="<?= base_url('adminlte/plugins/jquery/jquery.min.js') ?>"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url('adminlte/dist/js/adminlte.min.js') ?>"></script>
</body>

</html>