<?php

namespace App\Controllers;

use App\Models\PoliModel;

class Poli extends BaseController
{
  protected $poliModel;

  public function __construct()
  {
    $this->poliModel = new PoliModel();
    helper(['form', 'url']); // Load helpers here to make them available in all methods
  }

  public function index()
  {
    $poliData = $this->poliModel->findAll(); // Fetch all records from the model

    $data = [
      'poli' => $poliData
    ];
    return view('poli/poli', $data);
  }

  public function create()
  {
    return view('poli/create');
  }

  /**
   * Store function
   */
  public function store()
  {
    // Define validation
    $validation = $this->validate([
      'nama_poli' => [
        'rules'  => 'required',
        'errors' => [
          'required' => 'Masukkan Nama Poli.'
        ]
      ],
      'keterangan' => [
      ],
    ]);

    if (!$validation) {
      // Render view with error validation message
      return view('poli/create', [
        'validation' => $this->validator
      ]);
    } else {
      // Insert data into database
      $this->poliModel->insert([
        'nama_poli' => $this->request->getPost('nama_poli'),
        'keterangan' => $this->request->getPost('keterangan'),
      ]);

      // Flash message
      session()->setFlashdata('message', 'Poli Berhasil Ditambahkan');

      return redirect()->to(base_url('poli'));
    }
  }

  public function edit($id)
  {
    $poli = $this->poliModel->find($id);

    if (!$poli) {
      // Handle case where the poli is not found
      session()->setFlashdata('message', 'Data tidak ditemukan');
      return redirect()->to(base_url('poli'));
    }

    $data = [
      'id' => $poli['id'],
      'nama_poli' => $poli['nama_poli'],
      'keterangan' => $poli['keterangan'],
    ];

    return view('poli/edit', $data);
  }

  /**
   * Update function
   */
  public function update($id)
  {
    // Get the current record to check its existing 'tanggal' value
    $currentData = $this->poliModel->find($id);

    // Define validation rules, allowing the same 'tanggal' if it hasn't changed
    $validation = $this->validate([
      'nama_poli' => [
        'rules'  => 'required',
        'errors' => [
          'required' => 'Masukkan Nama Poli.'
        ]
      ],
      'keterangan' => [
      ],
    ]);

    if (!$validation) {
      // Pass the current data and validation errors to the view
      return view('poli/edit', [
        'id' => $currentData['id'],
        'nama_poli' => $currentData['nama_poli'],
        'keterangan' => $currentData['keterangan'],
        'validation' => $this->validator
      ]);
    } else {
      // Update data in the database
      $this->poliModel->update($id, [
        'nama_poli' => $this->request->getPost('nama_poli'),
        'keterangan' => $this->request->getPost('keterangan'),
      ]);

      // Flash message
      session()->setFlashdata('message', 'Poli Berhasil Diupdate');
      return redirect()->to(base_url('poli'));
    }
  }

  /**
   * Delete function
   */
  public function delete($id)
  {
    $poli = $this->poliModel->find($id);

    if ($poli) {
      $this->poliModel->delete($id);

      // Flash message
      session()->setFlashdata('message', 'Poli Berhasil Dihapus');

      return redirect()->to(base_url('poli'));
    } else {
      // Flash message
      session()->setFlashdata('message', 'Data tidak ditemukan');
      return redirect()->to(base_url('poli'));
    }
  }
}
