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

            <div class="alert alert-success w-100">
              <?php echo session()->getFlashdata('message'); ?>
            </div>

          <?php endif ?>

          <?php if (!empty(session()->getFlashdata('error'))) : ?>

            <div class="alert alert-danger w-100">
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
              <h3 class="card-title">Update Jadwal Periksa</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form action="<?php echo base_url('dokter/updateJadwalPeriksa/' . $id) ?>" method="POST">
                <div class="form-group">
                  <label>Hari</label>
                  <select name="hari" class="form-control">
                    <option value="Senin" <?= $hari == 'Senin' ? 'selected' : '' ?>>Senin</option>
                    <option value="Selasa" <?= $hari == 'Selasa' ? 'selected' : '' ?>>Selasa</option>
                    <option value="Rabu" <?= $hari == 'Rabu' ? 'selected' : '' ?>>Rabu</option>
                    <option value="Kamis" <?= $hari == 'Kamis' ? 'selected' : '' ?>>Kamis</option>
                    <option value="Jumat" <?= $hari == 'Jumat' ? 'selected' : '' ?>>Jumat</option>
                    <option value="Sabtu" <?= $hari == 'Sabtu' ? 'selected' : '' ?>>Sabtu</option>
                    <option value="Minggu" <?= $hari == 'Minggu' ? 'selected' : '' ?>>Minggu</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>Jam Mulai</label>
                  <input type="time" name="jam_mulai" id="" class="form-control" value="<?= $jam_mulai ?>">
                </div>
                <div class="form-group">
                  <label>Jam Selesai</label>
                  <input type="time" name="jam_selesai" id="" class="form-control" value="<?= $jam_selesai ?>">
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