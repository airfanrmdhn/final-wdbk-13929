<!-- app/Views/home.php -->
<?= $this->extend('template') ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content mx-2">
    <div class="container-fcol-lg-4luid">
      <?php if (session()->get('role') == 'admin') : ?>
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-4 col-4">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3><?= $jumlahPoli ?></h3>

                <p>Jumlah Poli</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-4">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3><?= $jumlahDokter ?></h3>

                <p>Jumlah Dokter</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-4">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3><?= $jumlahPasien ?></h3>

                <p>Jumlah Pasien</p>
              </div>
            </div>
          </div>

          <!-- ./col -->
        </div>
        <!-- /.row -->
      <?php endif ?>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<?= $this->endSection() ?>