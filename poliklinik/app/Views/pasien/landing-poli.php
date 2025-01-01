<!-- app/Views/home.php -->
<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 class="m-0">Pendaftaran Berhasil</h1>

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
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"></h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <tbody>
                  <tr>
                    <td>No RM</td>
                    <td><?= $data['no_rm'] ?></td>
                  </tr>
                  <tr>
                    <td>Nama Pasien</td>
                    <td><?= $data['nama_pasien'] ?></td>
                  </tr>
                  <tr>
                    <td>Nama Dokter</td>
                    <td><?= $data['nama_dokter'] ?></td>
                  </tr>
                  <tr>
                    <td>Jadwal</td>
                    <td><?= $data['hari'] ?>, <?= $data['jam_mulai'] ?> - <?= $data['jam_selesai'] ?></td>
                  </tr>
                  <tr>
                    <td>Keluhan</td>
                    <td><?= $data['keluhan'] ?></td>
                  </tr>
                  <tr>
                    <td>No Antrian</td>
                    <td><?= $data['no_antrian'] ?></td>
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
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<?= $this->endSection() ?>