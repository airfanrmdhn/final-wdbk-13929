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
              <h3 class="card-title">Riwayat Pendaftaran</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Dokter</th>
                    <th>Keluhan</th>
                    <th>No Antrian</th>
                    <th>Status Periksa</th>
                  </tr>
                </thead>
                <tbody>
                  <?php foreach ($riwayatDaftar as $key => $riwayatDaftar) : ?>
                    <tr class="<?= $riwayatDaftar['status'] == 'Sudah Diperiksa' ? 'bg-success' : '' ?>">
                      <td><?= $key + 1 ?></td>
                      <td><?= $riwayatDaftar['nama'] ?></td>
                      <td><?= $riwayatDaftar['keluhan'] ?></td>
                      <td><?= $riwayatDaftar['no_antrian'] ?></td>
                      <td><?= $riwayatDaftar['status'] ?></td>
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
          <?php if (isset($validation)) { ?>
            <div class="alert alert-danger" role="alert">
              <?php echo $validation->listErrors() ?>
            </div>
          <?php } ?>
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Tambah Pasien</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form action="<?php echo base_url('pasien/storeDaftarPoli') ?>" method="POST">
                <div class="form-group">
                  <label>Pilih Dokter</label>
                  <select name="dokter" id="dokter" class="form-control">
                    <option value="">--- Silahkan Pilih Dokter ---</option>
                    <?php foreach ($dokter as $dokter): ?>
                      <option value="<?= $dokter['id'] ?>"><?= $dokter['nama'] ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Pilih Jadwal</label>
                  <select name="id_jadwal" id="id_jadwal" class="form-control">
                  </select>
                </div>
                <div class="form-group">
                  <label>Keluhan</label>
                  <input type="text" class="form-control" name="keluhan" placeholder="Masukkan Keluhan">
                </div>
                <button type="submit" class="btn btn-primary" style="float: right;">Simpan</button>
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

<?= $this->section('script'); ?>
<script>
  $(document).ready(function() {
    $('#dokter').change(function() {
      const dokterId = $(this).val();

      // Jika tidak ada dokter yang dipilih, kosongkan dropdown jadwal
      if (dokterId === "") {
        $('#id_jadwal').html('<option value="">--- Silahkan Pilih Jadwal ---</option>');
        return;
      }

      // AJAX request untuk mengambil jadwal berdasarkan dokter
      $.ajax({
        url: '<?php echo base_url("pasien/getJadwalDokter"); ?>',
        type: 'POST',
        data: {
          id_dokter: dokterId
        },
        dataType: 'json',
        success: function(response) {
          let options = '<option value="">--- Silahkan Pilih Jadwal ---</option>';
          if (response.length > 0) {
            response.forEach(function(jadwal) {
              options += `<option value="${jadwal.id}">${jadwal.hari}, ${jadwal.jam_mulai} - ${jadwal.jam_selesai}</option>`;
            });
          } else {
            options = '<option value="">Tidak ada jadwal tersedia</option>';
          }
          $('#id_jadwal').html(options);
        },
        error: function() {
          alert('Gagal mengambil data jadwal. Silakan coba lagi.');
        }
      });
    });
  });
</script>
<?= $this->endSection(); ?>