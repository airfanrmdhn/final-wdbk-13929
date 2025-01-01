<?php

namespace App\Controllers;

date_default_timezone_set("Asia/Jakarta");

use App\Models\DaftarPoliModel;
use App\Models\DetailPeriksaModel;
use App\Models\DokterModel;
use App\Models\JadwalPeriksaModel;
use App\Models\ObatModel;
use App\Models\PeriksaModel;
use App\Models\PoliModel;
use App\Models\UsersModel;

class Dokter extends BaseController
{
  protected $dokterModel;
  protected $poliModel;
  protected $userModel;
  protected $jadwalPeriksaModel;
  protected $daftarPoliModel;
  protected $obatModel;
  protected $periksaModel;
  protected $detailPeriksaModel;

  public function __construct()
  {
    $this->dokterModel = new DokterModel();
    $this->poliModel = new PoliModel();
    $this->userModel = new UsersModel();
    $this->jadwalPeriksaModel = new JadwalPeriksaModel();
    $this->daftarPoliModel = new DaftarPoliModel();
    $this->obatModel = new ObatModel();
    $this->periksaModel = new PeriksaModel();
    $this->detailPeriksaModel = new DetailPeriksaModel();
    helper(['form', 'url']); // Load helpers here to make them available in all methods
  }

  public function index()
  {
    $dokterData = $this->dokterModel
      ->select('*, dokter.id as id')
      ->join('poli', 'dokter.id_poli = poli.id')
      ->findAll(); // Fetch all records from the model

    $data = [
      'dokter' => $dokterData
    ];
    return view('dokter/dokter', $data);
  }

  public function create()
  {
    $poliData = $this->poliModel->findAll();

    $data = [
      'poli' => $poliData,
    ];

    return view('dokter/create', $data);
  }

  /**
   * Store function
   */
  public function store()
  {
    // Define validation
    $validation = $this->validate([
      'nama' => [
        'rules'  => 'required',
        'errors' => [
          'required' => 'Masukkan Nama Dokter.'
        ]
      ],
      'alamat' => [],
      'no_hp' => [
        'rules'  => 'required',
        'errors' => [
          'required' => 'Masukkan No HP Dokter.'
        ]
      ],
      'id_poli' => [
        'rules'  => 'required',
        'errors' => [
          'required' => 'Silahkan Pilih Poli.'
        ]
      ],
    ]);

    if (!$validation) {
      // Render view with error validation message
      $poliData = $this->poliModel->findAll();
      return view('dokter/create', [
        'poli' => $poliData,
        'validation' => $this->validator
      ]);
    } else {
      // Insert data into database
      $this->dokterModel->insert([
        'nama' => $this->request->getPost('nama'),
        'alamat' => $this->request->getPost('alamat'),
        'no_hp' => $this->request->getPost('no_hp'),
        'id_poli' => $this->request->getPost('id_poli'),
      ]);

      // Get last inserted ID from dokter table
      $dokterId = $this->dokterModel->getInsertID();

      // Prepare username by removing spaces and converting to lowercase
      $username = strtolower(str_replace(' ', '', $this->request->getPost('nama')));

      // Insert data into users table
      $this->userModel->insert([
        'username' => $username,
        'password' => password_hash('dokter123', PASSWORD_BCRYPT), // Use proper password hashing
        'role' => 'dokter',
        'dokter_id' => $dokterId
      ]);

      // Flash message
      session()->setFlashdata('message', 'Dokter Berhasil Ditambahkan');

      return redirect()->to(base_url('dokter'));
    }
  }

  public function edit($id)
  {
    $dokter = $this->dokterModel->find($id);
    $poliData = $this->poliModel->findAll();

    if (!$dokter) {
      // Handle case where the dokter is not found
      session()->setFlashdata('message', 'Data tidak ditemukan');
      return redirect()->to(base_url('dokter'));
    }

    $data = [
      'id' => $dokter['id'],
      'nama' => $dokter['nama'],
      'alamat' => $dokter['alamat'],
      'no_hp' => $dokter['no_hp'],
      'id_poli' => $dokter['id_poli'],
      'poli' => $poliData,
    ];

    return view('dokter/edit', $data);
  }

  /**
   * Update function
   */
  public function update($id)
  {
    // Get the current record to check its existing 'tanggal' value
    $currentData = $this->dokterModel->find($id);

    // Define validation rules, allowing the same 'tanggal' if it hasn't changed
    $validation = $this->validate([
      'nama' => [
        'rules'  => 'required',
        'errors' => [
          'required' => 'Masukkan Nama Dokter.'
        ]
      ],
      'alamat' => [],
      'no_hp' => [
        'rules'  => 'required',
        'errors' => [
          'required' => 'Masukkan No HP Dokter.'
        ]
      ],
      'id_poli' => [
        'rules'  => 'required',
        'errors' => [
          'required' => 'Silahkan Pilih Poli.'
        ]
      ],
    ]);

    if (!$validation) {
      $poliData = $this->poliModel->findAll();
      // Pass the current data and validation errors to the view
      return view('dokter/edit', [
        'id' => $currentData['id'],
        'nama' => $currentData['nama'],
        'alamat' => $currentData['alamat'],
        'no_hp' => $currentData['no_hp'],
        'id_poli' => $currentData['id_poli'],
        'poli' => $poliData,
        'validation' => $this->validator
      ]);
    } else {
      // Update data in the database
      $this->dokterModel->update($id, [
        'nama' => $this->request->getPost('nama'),
        'alamat' => $this->request->getPost('alamat'),
        'no_hp' => $this->request->getPost('no_hp'),
        'id_poli' => $this->request->getPost('id_poli'),
      ]);

      // Flash message
      session()->setFlashdata('message', 'Dokter Berhasil Diupdate');
      return redirect()->to(base_url('dokter'));
    }
  }

  /**
   * Delete function
   */
  public function delete($id)
  {
    $dokter = $this->dokterModel->find($id);

    if ($dokter) {
      $this->dokterModel->delete($id);
      $this->userModel->where('dokter_id', $id)->delete();

      // Flash message
      session()->setFlashdata('message', 'Dokter Berhasil Dihapus');

      return redirect()->to(base_url('dokter'));
    } else {
      // Flash message
      session()->setFlashdata('message', 'Data tidak ditemukan');
      return redirect()->to(base_url('dokter'));
    }
  }

  public function profile()
  {
    $id = session()->get('dokter_id');
    $dokter = $this->dokterModel
      ->join('poli', 'dokter.id_poli = poli.id')
      ->find($id);

    return view('dokter/profile', compact('dokter'));
  }

  public function editData()
  {
    $id = session()->get('dokter_id');
    $dokter = $this->dokterModel->find($id);
    $poliData = $this->poliModel->findAll();

    if (!$dokter) {
      // Handle case where the dokter is not found
      session()->setFlashdata('message', 'Data tidak ditemukan');
      return redirect()->to(base_url('/'));
    }

    $data = [
      'id' => $dokter['id'],
      'nama' => $dokter['nama'],
      'alamat' => $dokter['alamat'],
      'no_hp' => $dokter['no_hp'],
      'id_poli' => $dokter['id_poli'],
      'poli' => $poliData,
    ];

    return view('dokter/edit-data', $data);
  }

  public function updateData($id)
  {
    // Get the current record to check its existing 'tanggal' value
    $currentData = $this->dokterModel->find($id);

    // Define validation rules, allowing the same 'tanggal' if it hasn't changed
    $validation = $this->validate([
      'nama' => [
        'rules'  => 'required',
        'errors' => [
          'required' => 'Masukkan Nama Dokter.'
        ]
      ],
      'alamat' => [],
      'no_hp' => [
        'rules'  => 'required',
        'errors' => [
          'required' => 'Masukkan No HP Dokter.'
        ]
      ],
      'id_poli' => [
        'rules'  => 'required',
        'errors' => [
          'required' => 'Silahkan Pilih Poli.'
        ]
      ],
    ]);

    if (!$validation) {
      $poliData = $this->poliModel->findAll();
      // Pass the current data and validation errors to the view
      return view('dokter/edit', [
        'id' => $currentData['id'],
        'nama' => $currentData['nama'],
        'alamat' => $currentData['alamat'],
        'no_hp' => $currentData['no_hp'],
        'id_poli' => $currentData['id_poli'],
        'poli' => $poliData,
        'validation' => $this->validator
      ]);
    } else {
      // Update data in the database
      $this->dokterModel->update($id, [
        'nama' => $this->request->getPost('nama'),
        'alamat' => $this->request->getPost('alamat'),
        'no_hp' => $this->request->getPost('no_hp'),
        'id_poli' => $this->request->getPost('id_poli'),
      ]);

      if ($this->request->getPost('password')) {
        $password = $this->request->getPost('password');
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $this->userModel
          ->where('dokter_id', $id)
          ->set(['password' => $hashedPassword])
          ->update();
      }

      // Flash message
      session()->setFlashdata('message', 'Dokter Berhasil Diupdate');
      return redirect()->to(base_url('dokter/profile'));
    }
  }

  public function jadwalPeriksa()
  {
    $id = session()->get('dokter_id');
    $jadwalPeriksa = $this->jadwalPeriksaModel->where('id_dokter', $id)->findAll();

    return view('dokter/jadwal', compact('jadwalPeriksa'));
  }

  public function createJadwalPeriksa()
  {
    return view('dokter/create-jadwal');
  }

  public function storeJadwalPeriksa()
  {
    // Validasi input
    $validation = $this->validate([
      'hari' => [
        'rules'  => 'required',
        'errors' => [
          'required' => 'Masukkan Hari Periksa.'
        ]
      ],
      'jam_mulai' => [
        'rules'  => 'required',
        'errors' => [
          'required' => 'Masukkan Jam Mulai Periksa.'
        ]
      ],
      'jam_selesai' => [
        'rules'  => 'required',
        'errors' => [
          'required' => 'Masukkan Jam Selesai Periksa.'
        ]
      ],
    ]);

    if (!$validation) {
      return view('dokter/create-jadwal', ['validation' => $this->validator]);
    }

    // Ambil jadwal dokter yang ada
    $jadwalExist = $this->jadwalPeriksaModel
      ->where('id_dokter', session()->get('dokter_id'))
      ->where('hari', $this->request->getPost('hari'))
      ->where('jam_mulai <', $this->request->getPost('jam_selesai'))
      ->where('jam_selesai >', $this->request->getPost('jam_mulai'))
      ->first();

    if ($jadwalExist) {
      session()->setFlashdata('error', 'Jadwal bertumbukan dengan jadwal yang sudah ada.');
      return redirect()->back()->withInput();
    }

    // Hanya satu jadwal aktif
    $this->jadwalPeriksaModel->where('id_dokter', session()->get('dokter_id'))
      ->set(['aktif' => 0])
      ->update();

    // Simpan jadwal
    $this->jadwalPeriksaModel->insert([
      'id_dokter' => session()->get('dokter_id'),
      'hari' => $this->request->getPost('hari'),
      'jam_mulai' => $this->request->getPost('jam_mulai'),
      'jam_selesai' => $this->request->getPost('jam_selesai'),
      'aktif' => 1,
    ]);

    session()->setFlashdata('message', 'Jadwal Periksa Berhasil Ditambahkan');
    return redirect()->to(base_url('dokter/jadwalPeriksa'));
  }

  public function editJadwalPeriksa($id)
  {
    $jadwalPeriksa = $this->jadwalPeriksaModel->find($id);

    if (!$jadwalPeriksa) {
      // Handle case where the jadwalPeriksa is not found
      session()->setFlashdata('message', 'Data tidak ditemukan');
      return redirect()->to(base_url('dokter/jadwalPeriksa'));
    }

    $data = [
      'id' => $jadwalPeriksa['id'],
      'hari' => $jadwalPeriksa['hari'],
      'jam_mulai' => $jadwalPeriksa['jam_mulai'],
      'jam_selesai' => $jadwalPeriksa['jam_selesai'],
    ];

    return view('dokter/edit-jadwal', $data);
  }

  private function getHariIndonesia($hariInggris)
  {
    $days = [
      'Sunday' => 'Minggu',
      'Monday' => 'Senin',
      'Tuesday' => 'Selasa',
      'Wednesday' => 'Rabu',
      'Thursday' => 'Kamis',
      'Friday' => 'Jumat',
      'Saturday' => 'Sabtu',
    ];

    return $days[$hariInggris] ?? $hariInggris;
  }

  public function updateJadwalPeriksa($id)
  {
    $currentData = $this->jadwalPeriksaModel->find($id);

    // Konversi hari saat ini ke format Indonesia
    $hariSekarang = $this->getHariIndonesia(date('l'));

    // Cek apakah jadwal adalah hari H
    if ($currentData && $currentData['hari'] === $hariSekarang) {
      session()->setFlashdata('message', 'Jadwal tidak dapat diubah pada hari H.');
      return redirect()->to(base_url('dokter/jadwalPeriksa'));
    }
    // Validasi input
    $validation = $this->validate([
      'hari' => [
        'rules'  => 'required',
        'errors' => [
          'required' => 'Masukkan Hari Periksa.'
        ]
      ],
      'jam_mulai' => [
        'rules'  => 'required',
        'errors' => [
          'required' => 'Masukkan Jam Mulai Periksa.'
        ]
      ],
      'jam_selesai' => [
        'rules'  => 'required',
        'errors' => [
          'required' => 'Masukkan Jam Selesai Periksa.'
        ]
      ],
    ]);

    if (!$validation) {
      return view('dokter/edit-jadwal', [
        'id' => $currentData['id'],
        'hari' => $currentData['hari'],
        'jam_mulai' => $currentData['jam_mulai'],
        'jam_selesai' => $currentData['jam_selesai'],
        'validation' => $this->validator
      ]);
    }

    // Cek jadwal bertumbukan
    $jadwalExist = $this->jadwalPeriksaModel
      ->where('id_dokter', session()->get('dokter_id'))
      ->where('hari', $this->request->getPost('hari'))
      ->where('jam_mulai <', $this->request->getPost('jam_selesai'))
      ->where('jam_selesai >', $this->request->getPost('jam_mulai'))
      ->where('id !=', $id)
      ->first();

    if ($jadwalExist) {
      session()->setFlashdata('error', 'Jadwal bertumbukan dengan jadwal yang sudah ada.');
      return redirect()->back()->withInput();
    }

    // Update data
    $this->jadwalPeriksaModel->update($id, [
      'hari' => $this->request->getPost('hari'),
      'jam_mulai' => $this->request->getPost('jam_mulai'),
      'jam_selesai' => $this->request->getPost('jam_selesai'),
    ]);

    session()->setFlashdata('message', 'Jadwal Periksa Berhasil Diupdate');
    return redirect()->to(base_url('dokter/jadwalPeriksa'));
  }

  public function daftarPeriksa()
  {
    $id = session()->get('dokter_id');

    $daftarPasien = $this->daftarPoliModel
      ->select("*, daftar_poli.id as id,
              CASE
                WHEN periksa.id IS NULL THEN 'Belum Diperiksa'
                ELSE 'Sudah Diperiksa'
              END as status")
      ->join('pasien', 'daftar_poli.id_pasien = pasien.id')
      ->join('jadwal_periksa', 'jadwal_periksa.id = daftar_poli.id_jadwal')
      ->join('periksa', 'daftar_poli.id = periksa.id_daftar_poli', 'left')
      ->where('jadwal_periksa.id_dokter', $id)
      ->orderBy('status', 'ASC')
      ->findAll();

    return view('dokter/list-periksa', compact('daftarPasien'));
  }

  public function periksaPasien($id)
  {
    $detailPasien = $this->daftarPoliModel
      ->select("*, daftar_poli.id as id, periksa.id as id_periksa")
      ->join('pasien', 'daftar_poli.id_pasien = pasien.id')
      ->join('jadwal_periksa', 'jadwal_periksa.id = daftar_poli.id_jadwal')
      ->join('periksa', 'daftar_poli.id = periksa.id_daftar_poli', 'left')
      ->where('daftar_poli.id', $id)
      ->first();

    $obat = $this->obatModel->findAll();

    $obatPasien = [];
    if (!empty($detailPasien['id_periksa'])) {
      $obatPasien = $this->detailPeriksaModel
        ->select('*, detail_periksa.id as id')
        ->join('obat', 'obat.id = detail_periksa.id_obat')
        ->where('id_periksa', $detailPasien['id_periksa'])
        ->findAll();
    }

    $riwayatPasien = $this->daftarPoliModel
      ->select("*, daftar_poli.id as id, periksa.id as id_periksa, pasien.id as id_pasien, jadwal_periksa.id_dokter as id_dokter")
      ->join('pasien', 'daftar_poli.id_pasien = pasien.id')
      ->join('jadwal_periksa', 'jadwal_periksa.id = daftar_poli.id_jadwal')
      ->join('periksa', 'daftar_poli.id = periksa.id_daftar_poli')
      ->where('pasien.id', $detailPasien['id_pasien'])
      ->where('jadwal_periksa.id_dokter', $detailPasien['id_dokter'])
      ->limit(10)
      ->findAll();

    return view('dokter/periksa-pasien', compact('detailPasien', 'obat', 'obatPasien', 'riwayatPasien'));
  }

  public function storePeriksa($id)
  {
    $periksa = $this->periksaModel
      ->where('id_daftar_poli', $id)
      ->first();

    if (!$periksa) {
      $periksa = $this->periksaModel->insert([
        'id_daftar_poli' => $id,
        'tgl_periksa' => $this->request->getPost('tgl_periksa'),
        'catatan' => $this->request->getPost('catatan'),
      ]);

      // Get last inserted ID from dokter table
      $periksaId = $this->periksaModel->getInsertID();
    } else {
      $periksaId = $periksa['id'];

      $this->periksaModel->update($periksaId, [
        'catatan' => $this->request->getPost('catatan'),
      ]);
    }

    $obat = $this->request->getPost('obat');

    for ($i = 0; $i < count($obat); $i++) {
      if ($obat[$i] == '') {
        continue;
      }
      $this->detailPeriksaModel->insert([
        'id_periksa' => $periksaId,
        'id_obat' => $obat[$i]
      ]);
    }


    $biayaObat = $this->detailPeriksaModel
      ->select('sum(obat.harga) as total')
      ->join('obat', 'obat.id = detail_periksa.id_obat')
      ->where('id_periksa', $periksaId)->first();
    $biayaPeriksa = 150000 + $biayaObat['total'];

    $this->periksaModel->update($periksaId, [
      'biaya_periksa' => $biayaPeriksa
    ]);

    session()->setFlashdata('message', 'Periksa Berhasil Diupdate');
    return redirect()->to(base_url('dokter/periksaPasien/' . $id));
  }

  public function deleteObatPasien($idDaftarPoli, $id)
  {
    $obatPasien = $this->detailPeriksaModel->find($id);

    if ($obatPasien) {
      $this->detailPeriksaModel->delete($id);

      $periksa = $this->periksaModel
        ->where('id_daftar_poli', $idDaftarPoli)
        ->first();

      $periksaId = $periksa['id'];

      $biayaObat = $this->detailPeriksaModel
        ->select('sum(obat.harga) as total')
        ->join('obat', 'obat.id = detail_periksa.id_obat')
        ->where('id_periksa', $periksaId)->first();
      $biayaPeriksa = 150000 + $biayaObat['total'];

      $this->periksaModel->update($periksaId, [
        'biaya_periksa' => $biayaPeriksa
      ]);

      // Flash message
      session()->setFlashdata('message', 'Obat Pasien Berhasil Dihapus');

      return redirect()->to(base_url('dokter/periksaPasien/' . $idDaftarPoli));
    } else {
      // Flash message
      session()->setFlashdata('message', 'Data tidak ditemukan');
      return redirect()->to(base_url('dokter/periksaPasien/' . $idDaftarPoli));
    }
  }

  public function riwayatPeriksa()
  {
    $id = session()->get('dokter_id');

    $daftarPasien = $this->daftarPoliModel
      ->select("
        daftar_poli.id as id,
        pasien.nama,
        daftar_poli.keluhan,
        periksa.tgl_periksa,
        periksa.catatan,
        CONCAT('[', GROUP_CONCAT(JSON_OBJECT('id', obat.id, 'nama', obat.nama_obat)), ']') as obat
    ")
      ->join('pasien', 'daftar_poli.id_pasien = pasien.id')
      ->join('jadwal_periksa', 'jadwal_periksa.id = daftar_poli.id_jadwal')
      ->join('periksa', 'daftar_poli.id = periksa.id_daftar_poli')
      ->join('detail_periksa', 'periksa.id = detail_periksa.id_periksa', 'left')
      ->join('obat', 'obat.id = detail_periksa.id_obat', 'left')
      ->where('jadwal_periksa.id_dokter', $id)
      ->groupBy('periksa.id')
      ->orderBy('periksa.tgl_periksa', 'ASC')
      ->findAll();

    return view('dokter/riwayat-periksa', compact('daftarPasien'));
  }
}
