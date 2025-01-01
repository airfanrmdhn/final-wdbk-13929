<!-- app/Views/home.php -->
<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 class="m-0">Periksa Pasien</h1>
          <br>
          <?php if (!empty(session()->getFlashdata('message'))) : ?>
            <div class="alert alert-success">
              <?= session()->getFlashdata('message'); ?>
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
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Pasien</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Nama Pasien</th>
                    <th>Keluhan</th>
                    <th>Total Biaya</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><?= $detailPasien['nama'] ?></td>
                    <td><?= $detailPasien['keluhan'] ?></td>
                    <td><?= $detailPasien['biaya_periksa'] ?></td>
                  </tr>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row (main row) -->

      <!-- Main row -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Periksa Pasien</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form action="<?php echo base_url('dokter/storePeriksa/' . $detailPasien['id']) ?>" method="POST">
                <div class="form-group">
                  <label>Tanggal Periksa</label>
                  <input type="date" class="form-control" name="tgl_periksa" value="<?= date('Y-m-d') ?>" readonly>
                </div>
                <div class="form-group">
                  <label>Catatan Dokter</label>
                  <textarea name="catatan" id="" class="form-control"><?= $detailPasien['catatan'] ?></textarea>
                </div>
                <div class="form-group">
                  <label>Obat</label>
                  <div id="obat-container">
                    <div class="obat-group mb-2">
                      <select name="obat[]" class="form-control">
                        <option value="">--- Silahkan Pilih Obat ---</option>
                        <?php foreach ($obat as $o): ?>
                          <option value="<?= $o['id'] ?>"><?= $o['nama_obat'] ?></option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                  <button type="button" id="add-obat" class="btn btn-success btn-sm mt-2">Tambah Obat</button>
                </div>
                <button type="submit" class="btn btn-primary" style="float:right">Simpan</button>
              </form>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row (main row) -->

      <!-- Main row -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Obat Pasien</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Nama Obat</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($obatPasien as $key => $obatPasien) : ?>
                    <tr>
                      <td><?= $obatPasien['nama_obat'] ?></td>
                      <td><a href="<?= base_url('dokter/deleteObatPasien/' . $detailPasien['id'] . '/' . $obatPasien['id']) ?>" class="btn btn-sm btn-danger">Hapus</a></td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row (main row) -->

      <!-- Main row -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Riwayat Periksa Pasien</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Tanggal Periksa</th>
                    <th>Catatan</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($riwayatPasien as $key => $riwayatPasien) : ?>
                    <tr>
                      <td><?= $riwayatPasien['tgl_periksa'] ?></td>
                      <td><?= $riwayatPasien['catatan'] ?></td>
                    </tr>
                  <?php endforeach ?>
                </tbody>
              </table>
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

<?= $this->section('script') ?>
<script>
  $(document).ready(function() {
    $('#add-obat').click(function() {
      // Clone the first obat-group
      const newObatGroup = $('.obat-group:first').clone();

      // Clear the selected value in the new dropdown
      newObatGroup.find('select').val('');

      // Append the new dropdown to the container
      $('#obat-container').append(newObatGroup);
    });
  });
</script>
<?= $this->endSection() ?>