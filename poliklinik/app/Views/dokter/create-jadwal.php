<!-- app/Views/home.php -->
<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 class="m-0">Dokter</h1>

          <?php if (!empty(session()->getFlashdata('message'))) : ?>

            <div class="alert alert-success">
              <?php echo session()->getFlashdata('message'); ?>
            </div>

          <?php endif ?>

          <?php if (!empty(session()->getFlashdata('error'))) : ?>

            <div class="alert alert-danger">
              <?php echo session()->getFlashdata('error'); ?>
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
              <h3 class="card-title">Tambah Jadwal Periksa</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form action="<?php echo base_url('dokter/storeJadwalPeriksa') ?>" method="POST">
                <div class="form-group">
                  <label>Hari</label>
                  <select name="hari" class="form-control">
                    <option value="Senin">Senin</option>
                    <option value="Selasa">Selasa</option>
                    <option value="Rabu">Rabu</option>
                    <option value="Kamis">Kamis</option>
                    <option value="Jumat">Jumat</option>
                    <option value="Sabtu">Sabtu</option>
                    <option value="Minggu">Minggu</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Jam Mulai</label>
                  <input type="time" name="jam_mulai" id="" class="form-control">
                </div>
                <div class="form-group">
                  <label>Jam Selesai</label>
                  <input type="time" name="jam_selesai" id="" class="form-control">
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