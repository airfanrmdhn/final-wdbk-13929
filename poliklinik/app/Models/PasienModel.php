<?php

namespace App\Models;

use CodeIgniter\Model;

class PasienModel extends Model
{
  /**
   * table name
   */
  protected $table = "pasien";

  /**
   * allowed Field
   */
  protected $protectFields = false;
}