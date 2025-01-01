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
              <h3 class="card-title">Data Dokter</h3>
              <a href="<?= base_url('dokter/create/') ?>" class="btn btn-sm btn-primary" style="float: right">Tambah Dokter</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Dokter</th>
                    <th>Alamat</th>
                    <th>No HP</th>
                    <th>Poli</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($dokter as $key => $dokter) : ?>
                    <tr>
                      <td><?= $key + 1 ?></td>
                      <td><?= $dokter['nama'] ?></td>
                      <td><?= $dokter['alamat'] ?></td>
                      <td><?= $dokter['no_hp'] ?></td>
                      <td><?= $dokter['nama_poli'] ?></td>
                      <td class="text-center">
                        <a href="<?= base_url('dokter/edit/' . $dokter['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="<?= base_url('dokter/delete/' . $dokter['id']) ?>" class="btn btn-sm btn-danger">Hapus</a>
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