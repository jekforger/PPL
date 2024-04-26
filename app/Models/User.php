<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nama', 'email', 'password'];

    // Validasi untuk register
    public function validateRegister($data)
    {
        $validationRules = [
            'nama' => 'required',
            'email' => 'required|valid_email|is_unique[user.email]',
            'password' => 'required|min_length[6]',
        ];

        return $this->validate($validationRules);
    }

    // Validasi untuk login
    public function validateLogin($data)
    {
        $validationRules = [
            'email' => 'required|valid_email',
            'password' => 'required',
        ];

        return $this->validate($validationRules);
    }

    // Fungsi untuk mencari user berdasarkan email
    public function getUserByEmail($email)
    {
        return $this->where('email', $email)->first();
    }
}
