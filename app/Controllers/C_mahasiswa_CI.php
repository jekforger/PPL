<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\M_mahasiswa_ci;

class C_mahasiswa_CI extends BaseController
{
    public function db()
{
    $model = new M_mahasiswa_ci();
    $data['mahasiswa'] = $model->orderBy('id', 'DESC')->findAll();
    return view('v_mahasiswa_ci', $data);

}


    
}