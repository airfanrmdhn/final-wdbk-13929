<?php

namespace App\Controllers;

use App\Models\DokterModel;
use App\Models\ObatModel;
use App\Models\PasienModel;
use App\Models\PoliModel;

class Home extends BaseController
{
  protected $poliModel;
  protected $pasienModel;
  protected $dokterModel;

  public function __construct()
  {
    $this->poliModel = new PoliModel();
    $this->pasienModel = new PasienModel();
    $this->dokterModel = new DokterModel();
    helper(['form', 'url']); // Load helpers here to make them available in all methods
  }

  public function index()
  {
    $poliData = $this->poliModel->countAllResults(); // Fetch all records from the model
    $pasienData = $this->pasienModel->countAllResults(); // Fetch all records from the model
    $dokterData = $this->dokterModel->countAllResults(); // Fetch all records from the model

    $data = [
      'jumlahPoli' => $poliData,
      'jumlahPasien' => $pasienData,
      'jumlahDokter' => $dokterData,
    ];
    return view('home', $data);
  }
}
