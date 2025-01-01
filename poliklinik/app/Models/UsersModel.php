<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
  /**
   * table name
   */
  protected $table = "users";

  /**
   * allowed Field
   */
  protected $protectFields = false;
  // protected $allowedFields = [
  //     'id',
  //     'username',
  //     'password'
  // ];
}
