<!-- app/Views/home.php -->
<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Obat</h1>

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
              <h3 class="card-title">Tambah Obat</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form action="<?php echo base_url('obat/store') ?>" method="POST">
                <div class="form-group">
                  <label>Nama Obat</label>
                  <input type="text" class="form-control" name="nama_obat" placeholder="Masukkan Nama Obat">
                </div>
                <div class="form-group">
                  <label>Kemasan Obat</label>
                  <input type="text" class="form-control" name="kemasan" placeholder="Masukkan Kemasan Obat">
                </div>
                <div class="form-group">
                  <label>Harga Obat</label>
                  <input type="number" class="form-control" name="harga" placeholder="Masukkan Harga Obat">
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
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