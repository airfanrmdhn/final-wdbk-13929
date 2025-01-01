<?php

namespace App\Controllers;

use App\Models\DaftarPoliModel;
use App\Models\DokterModel;
use App\Models\JadwalPeriksaModel;
use App\Models\UsersModel;
use App\Models\PasienModel;

class Pasien extends BaseController
{
  protected $pasienModel;
  protected $userModel;
  protected $daftarPoliModel;
  protected $dokterModel;
  protected $jadwalPeriksaModel;

  public function __construct()
  {
    $this->pasienModel = new PasienModel();
    $this->userModel = new UsersModel();
    $this->daftarPoliModel = new DaftarPoliModel();
    $this->dokterModel = new DokterModel();
    $this->jadwalPeriksaModel = new JadwalPeriksaModel();
    helper(['form', 'url']); // Load helpers here to make them available in all methods
  }

  public function index()
  {
    $pasienData = $this->pasienModel->findAll(); // Fetch all records from the model

    $data = [
      'pasien' => $pasienData
    ];
    return view('pasien/pasien', $data);
  }

  public function create()
  {
    return view('pasien/create');
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
          'required' => 'Masukkan Nama Pasien.'
        ]
      ],
      'alamat' => [
        'rules'  => 'required',
        'errors' => [
          'required' => 'Masukkan Alamat Pasien.'
        ]
      ],
      'no_ktp' => [
        'rules'  => 'required|is_unique[pasien.no_ktp]',
        'errors' => [
          'required' => 'Masukkan No KTP Pasien.',
          'is_unique' => 'No KTP Pasien sudah ada.'
        ]
      ],
      'no_hp' => [
        'rules'  => 'required',
        'errors' => [
          'required' => 'Masukkan No HP Pasien.'
        ]
      ],
    ]);

    if (!$validation) {
      // Render view with error validation message
      return view('pasien/create', [
        'validation' => $this->validator
      ]);
    } else {
      // Count total patients in the database
      $totalPatients = $this->pasienModel->countAll();

      // Insert data into database
      $this->pasienModel->insert([
        'nama' => $this->request->getPost('nama'),
        'alamat' => $this->request->getPost('alamat'),
        'no_ktp' => $this->request->getPost('no_ktp'),
        'no_hp' => $this->request->getPost('no_hp'),
      ]);

      // Get last inserted ID from pasien table
      $pasienId = $this->pasienModel->getInsertID();

      // Get current year and month
      $yearMonth = date('Y') . date('m');


      // Generate no_rm with year-month and patient order
      $no_rm = $yearMonth . '-' . ($totalPatients + 1);

      // Update no_rm in pasien table
      $this->pasienModel->update($pasienId, [
        'no_rm' => $no_rm
      ]);

      // Prepare username by removing spaces and converting to lowercase
      $username = strtolower(str_replace(' ', '', $this->request->getPost('nama')));

      // Insert data into users table
      $this->userModel->insert([
        'username' => $username,
        'password' => password_hash('pasien123', PASSWORD_BCRYPT), // Use proper password hashing
        'role' => 'pasien',
        'pasien_id' => $pasienId
      ]);

      // Flash message
      session()->setFlashdata('message', 'Pasien Berhasil Ditambahkan');

      return redirect()->to(base_url('pasien'));
    }
  }

  public function edit($id)
  {
    $pasien = $this->pasienModel->find($id);

    if (!$pasien) {
      // Handle case where the pasien is not found
      session()->setFlashdata('message', 'Data tidak ditemukan');
      return redirect()->to(base_url('pasien'));
    }

    $data = [
      'id' => $pasien['id'],
      'nama' => $pasien['nama'],
      'alamat' => $pasien['alamat'],
      'no_ktp' => $pasien['no_ktp'],
      'no_hp' => $pasien['no_hp'],
      'no_rm' => $pasien['no_rm'],
    ];

    return view('pasien/edit', $data);
  }

  /**
   * Update function
   */
  public function update($id)
  {
    // Get the current record to check its existing 'tanggal' value
    $currentData = $this->pasienModel->find($id);

    // Define validation rules, allowing the same 'tanggal' if it hasn't changed
    $validation = $this->validate([
      'nama' => [
        'rules'  => 'required',
        'errors' => [
          'required' => 'Masukkan Nama Pasien.'
        ]
      ],
      'alamat' => [
        'rules'  => 'required',
        'errors' => [
          'required' => 'Masukkan Alamat Pasien.'
        ]
      ],
      'no_ktp' => [
        'rules'  => 'required|is_unique[pasien.no_ktp,id,' . $id . ']',
        'errors' => [
          'required' => 'Masukkan No KTP Pasien.',
          'is_unique' => 'No KTP Pasien sudah ada.'
        ]
      ],
      'no_hp' => [
        'rules'  => 'required',
        'errors' => [
          'required' => 'Masukkan No HP Pasien.'
        ]
      ],
    ]);

    if (!$validation) {
      // Pass the current data and validation errors to the view
      return view('pasien/edit', [
        'id' => $currentData['id'],
        'nama' => $currentData['nama'],
        'alamat' => $currentData['alamat'],
        'no_ktp' => $currentData['no_ktp'],
        'no_hp' => $currentData['no_hp'],
        'validation' => $this->validator
      ]);
    } else {
      // Update data in the database
      $this->pasienModel->update($id, [
        'nama' => $this->request->getPost('nama'),
        'alamat' => $this->request->getPost('alamat'),
        'no_ktp' => $this->request->getPost('no_ktp'),
        'no_hp' => $this->request->getPost('no_hp'),
      ]);

      // Flash message
      session()->setFlashdata('message', 'Pasien Berhasil Diupdate');
      return redirect()->to(base_url('pasien'));
    }
  }

  /**
   * Delete function
   */
  public function delete($id)
  {
    $pasien = $this->pasienModel->find($id);

    if ($pasien) {
      $this->pasienModel->delete($id);
      $this->userModel->where('pasien_id', $id)->delete();

      // Flash message
      session()->setFlashdata('message', 'Pasien Berhasil Dihapus');

      return redirect()->to(base_url('pasien'));
    } else {
      // Flash message
      session()->setFlashdata('message', 'Data tidak ditemukan');
      return redirect()->to(base_url('pasien'));
    }
  }

  public function daftar()
  {
    return view('pasien/daftar');
  }

  public function prosesDaftar()
  {
    // Define validation
    $validation = $this->validate([
      'nama' => [
        'rules'  => 'required',
        'errors' => [
          'required' => 'Masukkan Nama Pasien.'
        ]
      ],
      'alamat' => [
        'rules'  => 'required',
        'errors' => [
          'required' => 'Masukkan Alamat Pasien.'
        ]
      ],
      'no_ktp' => [
        'rules'  => 'required|is_unique[pasien.no_ktp]',
        'errors' => [
          'required' => 'Masukkan No KTP Pasien.',
          'is_unique' => 'No KTP Pasien sudah ada.'
        ]
      ],
      'no_hp' => [
        'rules'  => 'required',
        'errors' => [
          'required' => 'Masukkan No HP Pasien.'
        ]
      ],
    ]);

    if (!$validation) {
      // Render view with error validation message
      return view('pasien/daftar', [
        'validation' => $this->validator
      ]);
    } else {
      // Count total patients in the database
      $totalPatients = $this->pasienModel->countAll();

      // Insert data into database
      $this->pasienModel->insert([
        'nama' => $this->request->getPost('nama'),
        'alamat' => $this->request->getPost('alamat'),
        'no_ktp' => $this->request->getPost('no_ktp'),
        'no_hp' => $this->request->getPost('no_hp'),
      ]);

      // Get last inserted ID from pasien table
      $pasienId = $this->pasienModel->getInsertID();

      // Get current year and month
      $yearMonth = date('Y') . date('m');

      // Generate no_rm with year-month and patient order
      $no_rm = $yearMonth . '-' . ($totalPatients + 1);

      // Update no_rm in pasien table
      $this->pasienModel->update($pasienId, [
        'no_rm' => $no_rm
      ]);

      // Prepare username by removing spaces and converting to lowercase
      $username = strtolower(str_replace(' ', '', $this->request->getPost('nama')));

      // Insert data into users table
      $this->userModel->insert([
        'username' => $username,
        'password' => password_hash('pasien123', PASSWORD_BCRYPT), // Use proper password hashing
        'role' => 'pasien',
        'pasien_id' => $pasienId
      ]);

      // Flash message
      session()->setFlashdata('message', 'Pasien Berhasil Ditambahkan');

      $data = [
        'nama' => $this->request->getPost('nama'),
        'alamat' => $this->request->getPost('alamat'),
        'no_ktp' => $this->request->getPost('no_ktp'),
        'no_hp' => $this->request->getPost('no_hp'),
        'username' => $username,
        'password' => 'pasien123',
        'no_rm' => $no_rm,
      ];

      return view('pasien/landing', $data);
    }
  }
  public function profile()
  {
    $id = session()->get('pasien_id');
    $pasien = $this->pasienModel
      ->find($id);

    return view('pasien/profile', compact('pasien'));
  }

  public function editData()
  {
    $id = session()->get('pasien_id');
    $pasien = $this->pasienModel->find($id);

    if (!$pasien) {
      // Handle case where the pasien is not found
      session()->setFlashdata('message', 'Data tidak ditemukan');
      return redirect()->to(base_url('/'));
    }

    $data = [
      'id' => $pasien['id'],
      'nama' => $pasien['nama'],
      'alamat' => $pasien['alamat'],
      'no_ktp' => $pasien['no_ktp'],
      'no_hp' => $pasien['no_hp'],
    ];

    return view('pasien/edit-data', $data);
  }

  public function updateData($id)
  {
    // Get the current record to check its existing 'tanggal' value
    $currentData = $this->pasienModel->find($id);

    // Define validation rules, allowing the same 'tanggal' if it hasn't changed
    $validation = $this->validate([
      'nama' => [
        'rules'  => 'required',
        'errors' => [
          'required' => 'Masukkan Nama Pasien.'
        ]
      ],
      'alamat' => [
        'rules'  => 'required',
        'errors' => [
          'required' => 'Masukkan Alamat Pasien.'
        ]
      ],
      'no_ktp' => [
        'rules'  => 'required|is_unique[pasien.no_ktp,id,' . $id . ']',
        'errors' => [
          'required' => 'Masukkan No KTP Pasien.',
          'is_unique' => 'No KTP Pasien sudah ada.'
        ]
      ],
      'no_hp' => [
        'rules'  => 'required',
        'errors' => [
          'required' => 'Masukkan No HP Pasien.'
        ]
      ],
    ]);

    if (!$validation) {
      // Pass the current data and validation errors to the view
      return view('pasien/edit-data', [
        'id' => $currentData['id'],
        'nama' => $currentData['nama'],
        'alamat' => $currentData['alamat'],
        'no_ktp' => $currentData['no_ktp'],
        'no_hp' => $currentData['no_hp'],
        'validation' => $this->validator
      ]);
    } else {
      // Update data in the database
      $this->pasienModel->update($id, [
        'nama' => $this->request->getPost('nama'),
        'alamat' => $this->request->getPost('alamat'),
        'no_ktp' => $this->request->getPost('no_ktp'),
        'no_hp' => $this->request->getPost('no_hp'),
      ]);

      if ($this->request->getPost('password')) {
        $password = $this->request->getPost('password');
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $this->userModel
          ->where('pasien_id', $id)
          ->set(['password' => $hashedPassword])
          ->update();
      }

      // Flash message
      session()->setFlashdata('message', 'Data Berhasil Diupdate');
      return redirect()->to(base_url('pasien/profile'));
    }
  }

  public function daftarPoli()
  {
    $id = session()->get('pasien_id');

    $riwayatDaftar = $this->daftarPoliModel
      ->select("*, daftar_poli.id as id,
              CASE
                WHEN periksa.id IS NULL THEN 'Belum Diperiksa'
                ELSE 'Sudah Diperiksa'
              END as status,
              dokter.nama as nama")
      ->join('pasien', 'daftar_poli.id_pasien = pasien.id')
      ->join('jadwal_periksa', 'jadwal_periksa.id = daftar_poli.id_jadwal')
      ->join('periksa', 'daftar_poli.id = periksa.id_daftar_poli', 'left')
      ->join('dokter', 'jadwal_periksa.id_dokter = dokter.id')
      ->where('daftar_poli.id_pasien', $id)
      ->orderBy('status', 'ASC')
      ->limit(10)
      ->findAll();

      $dokter = $this->dokterModel->findAll();

      return view('pasien/daftar-poli', compact('riwayatDaftar','dokter'));
  }

  public function getJadwalDokter()
  {
    if ($this->request->isAJAX()) {
      $idDokter = $this->request->getPost('id_dokter');

      // Ambil jadwal berdasarkan dokter
      $jadwal = $this->jadwalPeriksaModel
        ->select('id, hari, jam_mulai, jam_selesai')
        ->where('id_dokter', $idDokter)
        ->where('aktif', 1)
        ->findAll();

      // Kembalikan response JSON
      return $this->response->setJSON($jadwal);
    }

    // Jika bukan AJAX, kembalikan error
    throw new \CodeIgniter\Exceptions\PageNotFoundException();
  }

  public function storeDaftarPoli()
  {
    // Define validation
    $validation = $this->validate([
      'dokter' => [
        'rules'  => 'required',
        'errors' => [
          'required' => 'Silahkan Pilih Dokter.'
        ]
      ],
      'id_jadwal' => [
        'rules'  => 'required',
        'errors' => [
          'required' => 'Silahkan Pilih Jadwal.'
        ]
      ],
      'keluhan' => [
        'rules'  => 'required',
        'errors' => [
          'required' => 'Masukkan Keluhan.'
        ]
      ],
    ]);

    if (!$validation) {
      // Render view with error validation message
      return view('pasien/daftar-poli', [
        'validation' => $this->validator
      ]);
    } else {
      $id = session()->get('pasien_id');

      // Count total patients in the database
      $totalPatients = $this->daftarPoliModel->where('id_jadwal', $this->request->getPost('id_jadwal'))->countAll();
      // Insert data into database
      $this->daftarPoliModel->insert([
        'id_pasien' => $id,
        'id_jadwal' => $this->request->getPost('id_jadwal'),
        'keluhan' => $this->request->getPost('keluhan'),
        'no_antrian' => $totalPatients + 1,
      ]);

      $daftarPoliId = $this->daftarPoliModel->getInsertID();

      $data = $this->daftarPoliModel
      ->select("*, daftar_poli.id as id,
              CASE
                WHEN periksa.id IS NULL THEN 'Belum Diperiksa'
                ELSE 'Sudah Diperiksa'
              END as status,
              dokter.nama as nama_dokter,
              pasien.nama as nama_pasien")
      ->join('pasien', 'daftar_poli.id_pasien = pasien.id')
      ->join('jadwal_periksa', 'jadwal_periksa.id = daftar_poli.id_jadwal')
      ->join('periksa', 'daftar_poli.id = periksa.id_daftar_poli', 'left')
      ->join('dokter', 'jadwal_periksa.id_dokter = dokter.id')
      ->where('daftar_poli.id', $daftarPoliId)
      ->orderBy('status', 'ASC')
      ->first();

      // Flash message
      // session()->setFlashdata('message', 'Antrian Berhasil Ditambahkan');

      return view('pasien/landing-poli', compact('data'));
    }
  }
}
