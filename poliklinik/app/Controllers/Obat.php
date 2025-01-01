<?php

namespace App\Controllers;

use App\Models\ObatModel;

class Obat extends BaseController
{
  protected $obatModel;

  public function __construct()
  {
    $this->obatModel = new ObatModel();
    helper(['form', 'url']); // Load helpers here to make them available in all methods
  }

  public function index()
  {
    $obatData = $this->obatModel->findAll(); // Fetch all records from the model

    $data = [
      'obat' => $obatData
    ];
    return view('obat/obat', $data);
  }

  public function create()
  {
    return view('obat/create');
  }

  /**
   * Store function
   */
  public function store()
  {
    // Define validation
    $validation = $this->validate([
      'nama_obat' => [
        'rules'  => 'required',
        'errors' => [
          'required' => 'Masukkan Nama Obat.'
        ]
      ],
    ]);

    if (!$validation) {
      // Render view with error validation message
      return view('obat/create', [
        'validation' => $this->validator
      ]);
    } else {
      // Insert data into database
      $this->obatModel->insert([
        'nama_obat' => $this->request->getPost('nama_obat'),
        'kemasan' => $this->request->getPost('kemasan'),
        'harga' => $this->request->getPost('harga'),
      ]);

      // Flash message
      session()->setFlashdata('message', 'Obat Berhasil Ditambahkan');

      return redirect()->to(base_url('obat'));
    }
  }

  public function edit($id)
  {
    $obat = $this->obatModel->find($id);

    if (!$obat) {
      // Handle case where the obat is not found
      session()->setFlashdata('message', 'Data tidak ditemukan');
      return redirect()->to(base_url('obat'));
    }

    $data = [
      'id' => $obat['id'],
      'nama_obat' => $obat['nama_obat'],
      'kemasan' => $obat['kemasan'],
      'harga' => $obat['harga'],
    ];

    return view('obat/edit', $data);
  }

  /**
   * Update function
   */
  public function update($id)
  {
    // Get the current record to check its existing 'tanggal' value
    $currentData = $this->obatModel->find($id);

    // Define validation rules, allowing the same 'tanggal' if it hasn't changed
    $validation = $this->validate([
      'nama_obat' => [
        'rules'  => 'required',
        'errors' => [
          'required' => 'Masukkan Nama Obat.'
        ]
      ],
    ]);

    if (!$validation) {
      // Pass the current data and validation errors to the view
      return view('obat/edit', [
        'id' => $currentData['id'],
        'nama_obat' => $currentData['nama_obat'],
        'kemasan' => $currentData['kemasan'],
        'harga' => $currentData['harga'],
        'validation' => $this->validator
      ]);
    } else {
      // Update data in the database
      $this->obatModel->update($id, [
        'nama_obat' => $this->request->getPost('nama_obat'),
        'kemasan' => $this->request->getPost('kemasan'),
        'harga' => $this->request->getPost('harga'),
      ]);

      // Flash message
      session()->setFlashdata('message', 'Obat Berhasil Diupdate');
      return redirect()->to(base_url('obat'));
    }
  }

  /**
   * Delete function
   */
  public function delete($id)
  {
    $obat = $this->obatModel->find($id);

    if ($obat) {
      $this->obatModel->delete($id);

      // Flash message
      session()->setFlashdata('message', 'Obat Berhasil Dihapus');

      return redirect()->to(base_url('obat'));
    } else {
      // Flash message
      session()->setFlashdata('message', 'Data tidak ditemukan');
      return redirect()->to(base_url('obat'));
    }
  }
}
