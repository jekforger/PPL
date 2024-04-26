<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class C_validation extends Controller
{
    protected $request;

    public function __construct()
    {
        $this->request = service('request');
    }

    public function index()
    {
        return view('v_validation');
    }

    public function submit()
{
    $validation = \Config\Services::validation();

    $validation->setRules([
        'nip' => 'required',
        'nama' => 'required',
        'tgl_lahir' => 'required|valid_date',
        'gender' => 'required',
        'pendidikan' => 'required',
        'no_hp' => 'required|numeric',
        'email' => 'required|valid_email',
    ]);

    if (!$validation->withRequest($this->request)->run()) {
        // Jika validasi gagal, kembali ke halaman formulir dengan pesan kesalahan dan data yang dimasukkan
        return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    } else {
        // Jika validasi berhasil, arahkan pengguna ke halaman Home/welcome_message
        return redirect()->to('/');
    }
}

}
