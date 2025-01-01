<!-- app/Views/home.php -->
<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 class="m-0">List Periksa</h1>
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
                    <th>No</th>
                    <th>Nama Pasien</th>
                    <th>Keluhan</th>
                    <th>No Antrian</th>
                    <th>Status Periksa</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($daftarPasien as $key => $daftarPasien) : ?>
                    <tr class="<?= $daftarPasien['status'] == 'Sudah Diperiksa' ? 'bg-success' : '' ?>">
                      <td><?= $key + 1 ?></td>
                      <td><?= $daftarPasien['nama'] ?></td>
                      <td><?= $daftarPasien['keluhan'] ?></td>
                      <td><?= $daftarPasien['no_antrian'] ?></td>
                      <td><?= $daftarPasien['status'] ?></td>
                      <td class="text-center">
                        <a href="<?= base_url('dokter/periksaPasien/' . $daftarPasien['id']) ?>" class="btn btn-sm btn-primary">Periksa</a>
                      </td>
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