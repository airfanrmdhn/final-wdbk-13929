<!-- app/Views/home.php -->
<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dokter</h1>

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
              <h3 class="card-title">Profile Dokter</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form action="" method="POST">
                <div class="form-group">
                  <label>Nama Dokter</label>
                  <input type="text" class="form-control" value="<?= $dokter['nama'] ?>" readonly>
                </div>
                <div class="form-group">
                  <label>Alamat Dokter</label>
                  <input type="text" class="form-control" value="<?= $dokter['alamat'] ?>" readonly>
                </div>
                <div class="form-group">
                  <label>No HP Dokter</label>
                  <input type="text" class="form-control" value="<?= $dokter['no_hp'] ?>" readonly>
                </div>
                <div class="form-group">
                  <label>Poli Dokter</label>
                  <input type="text" class="form-control" value="<?= $dokter['nama_poli'] ?>" readonly>
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