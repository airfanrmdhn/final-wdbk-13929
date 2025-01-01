<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Registrasi</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url('adminlte/plugins/fontawesome-free/css/all.min.css') ?>">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url('adminlte/dist/css/adminlte.min.css') ?>">
</head>

<body class="hold-transition register-page">
  <?php if (isset($validation)) { ?>
    <div class="alert alert-danger" role="alert">
      <?php echo $validation->listErrors() ?>
    </div>
  <?php } ?>
  <div class="register-box">
    <div class="card card-outline card-primary">
      <div class="card-body">
        <p class="login-box-msg">Silahkan Registrasi</p>

        <form action="<?php echo base_url('pasien/prosesDaftar') ?>" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Nama" name="nama" required>
          </div>
          <div class="input-group mb-3">
            <textarea class="form-control" placeholder="Alamat" name="alamat" required></textarea>
          </div>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="No KTP" name="no_ktp" required>
          </div>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="No HP" name="no_hp" required>
          </div>
          <div class="row">
            <div class="col-8">
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Daftar</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <p class="mt-3 mb-1">
          <a href="<?php echo base_url('login') ?>">Sudah punya akun? Masuk di sini</a>
        </p>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>
  <!-- /.register-box -->

  <!-- jQuery -->
  <script src="<?= base_url('adminlte/plugins/jquery/jquery.min.js') ?>"></script>
  <!-- Bootstrap 4 -->
  <script src="<?= base_url('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>
  <!-- AdminLTE App -->
  <script src="<?= base_url('adminlte/dist/js/adminlte.min.js') ?>"></script>
</body>

</html>