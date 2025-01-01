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
              <a href="<?= base_url('pasien/create/') ?>" class="btn btn-sm btn-primary" style="float: right">Tambah Pasien</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Pasien</th>
                    <th>Alamat</th>
                    <th>No KTP</th>
                    <th>No HP</th>
                    <th>No RM</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($pasien as $key => $pasien) : ?>
                    <tr>
                      <td><?= $key + 1 ?></td>
                      <td><?= $pasien['nama'] ?></td>
                      <td><?= $pasien['alamat'] ?></td>
                      <td><?= $pasien['no_ktp'] ?></td>
                      <td><?= $pasien['no_hp'] ?></td>
                      <td><?= $pasien['no_rm'] ?></td>
                      <td class="text-center">
                        <a href="<?= base_url('pasien/edit/' . $pasien['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="<?= base_url('pasien/delete/' . $pasien['id']) ?>" class="btn btn-sm btn-danger">Hapus</a>
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