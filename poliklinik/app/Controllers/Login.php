<?php

namespace App\Controllers;

use App\Models\UsersModel;

class Login extends BaseController
{
  public function index()
  {
    return view('login/login');
  }

  public function process()
  {
    $user = new UsersModel();
    $username = $this->request->getPost('username');
    $password = $this->request->getPost('password');
    $dataUser = $user->where([
      'username' => $username,
    ])->first();
    if ($dataUser) {
      if (password_verify($password, $dataUser['password'])) {
        session()->set([
          'username' => $dataUser['username'],
          'logged_in' => TRUE,
          'role' => $dataUser['role'],
          'user_id' => $dataUser['id'],
          'dokter_id' => $dataUser['dokter_id'],
          'pasien_id' => $dataUser['pasien_id'],
        ]);
        return redirect()->to(base_url('home'));
      } else {
        session()->setFlashdata('error', 'Username & Password Salah');
        return redirect()->to(base_url('login/index'));
      }
    } else {
      session()->setFlashdata('error', 'Username & Password Salah');
      return redirect()->to(base_url('login/index'));
    }
  }

  function logout()
  {
    session()->destroy();
    return redirect()->to(base_url('login'));
  }
}
