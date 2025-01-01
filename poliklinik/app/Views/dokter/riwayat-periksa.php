<!-- app/Views/home.php -->
<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1 class="m-0">Riwayat Periksa</h1>
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
                    <th>Tanggal Periksa</th>
                    <th>Catatan</th>
                    <th>Obat</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($daftarPasien as $key => $daftarPasien) : ?>
                    <tr>
                      <td><?= $key + 1 ?></td>
                      <td><?= $daftarPasien['nama'] ?></td>
                      <td><?= $daftarPasien['keluhan'] ?></td>
                      <td><?= $daftarPasien['tgl_periksa'] ?></td>
                      <td><?= $daftarPasien['catatan'] ?></td>
                      <td>
                        <?php
                        $obatList = json_decode($daftarPasien['obat'], true);
                        if ($obatList) {
                          echo "<ol>"; // Start the ordered list
                          foreach ($obatList as $obat) {
                            echo $obat['nama'] ? "<li>" . htmlspecialchars($obat['nama']) . "</li>": ''; // Add each obat as a list item
                          }
                          echo "</ol>"; // Close the ordered list
                        }
                        ?>
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