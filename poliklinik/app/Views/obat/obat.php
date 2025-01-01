<!-- app/Views/home.php -->
<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 class="m-0">Obat</h1>
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
              <h3 class="card-title">Data Obat</h3>
              <a href="<?= base_url('obat/create/') ?>" class="btn btn-sm btn-primary" style="float: right">Tambah Obat</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Obat</th>
                    <th>Kemasan</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($obat as $key => $obat) : ?>
                    <tr>
                      <td><?= $key + 1 ?></td>
                      <td><?= $obat['nama_obat'] ?></td>
                      <td><?= $obat['kemasan'] ?></td>
                      <td><?= $obat['harga'] ?></td>
                      <td class="text-center">
                        <a href="<?= base_url('obat/edit/' . $obat['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="<?= base_url('obat/delete/' . $obat['id']) ?>" class="btn btn-sm btn-danger">Hapus</a>
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