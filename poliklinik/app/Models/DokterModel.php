<?php

namespace App\Models;

use CodeIgniter\Model;

class DokterModel extends Model
{
  /**
   * table name
   */
  protected $table = "dokter";

  /**
   * allowed Field
   */
  protected $protectFields = false;
}