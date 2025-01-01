<!-- app/Views/home.php -->
<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 class="m-0">Pasien</h1>

          <?php if (!empty(session()->getFlashdata('message'))) : ?>

            <div class="alert alert-success">
              <?php echo session()->getFlashdata('message'); ?>
            </div>

          <?php endif ?>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fcol-lg-4luid">
      <!-- Main row -->
      <div class="row">
        <div class="col-12">
          <?php if (isset($validation)) { ?>
            <div class="alert alert-danger" role="alert">
              <?php echo $validation->listErrors() ?>
            </div>
          <?php } ?>
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Pasien</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form action="" method="POST">
                <div class="form-group">
                  <label>Nama Pasien</label>
                  <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Pasien" value="<?= $pasien['nama'] ?>" readonly>
                </div>
                <div class="form-group">
                  <label>Alamat Pasien</label>
                  <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Pasien" value="<?= $pasien['alamat'] ?>" readonly>
                </div>
                <div class="form-group">
                  <label>No KTP Pasien</label>
                  <input type="text" class="form-control" name="no_ktp" placeholder="Masukkan No KTP Pasien" value="<?= $pasien['no_ktp'] ?>" readonly>
                </div>
                <div class="form-group">
                  <label>No HP Pasien</label>
                  <input type="text" class="form-control" name="no_hp" placeholder="Masukkan No HP Pasien" value="<?= $pasien['no_hp'] ?>" readonly>
                </div>
                <div class="form-group">
                  <label>No RM Pasien</label>
                  <input type="text" class="form-control" name="no_rm" placeholder="Masukkan No RM Pasien" value="<?= $pasien['no_rm'] ?>" readonly>
                </div>
              </form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<?= $this->endSection() ?>