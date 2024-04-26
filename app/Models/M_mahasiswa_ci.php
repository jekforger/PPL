<?php

namespace App\Models;

use CodeIgniter\Model;
use CodeIgniter\Database\ConnectionInterface;

class M_mahasiswa_ci extends Model
{

    protected $table = 'mahasiswa';

    protected $allowedFields = ['NIM','Nama','Umur'];
    
}