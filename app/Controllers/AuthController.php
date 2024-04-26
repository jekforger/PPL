<?php

namespace App\Controllers;

use App\Models\User;
use CodeIgniter\Controller;

class AuthController extends Controller
{
    public function register()
    {
        $userModel = new User();

        if ($this->request->getMethod() === 'post') {
            // Validasi input
            if (!$userModel->validateRegister($this->request->getPost())) {
                return redirect()->back()->withInput()->with('errors', $userModel->errors());
            }

            // Simpan data user baru
            $userModel->save([
                'nama' => $this->request->getPost('nama'),
                'email' => $this->request->getPost('email'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            ]);

            // Redirect ke halaman login
            return redirect()->to('authentication/login');
        }

        // Tampilkan halaman register
        return view('Authentication/register');

    }

    public function login()
    {
        $userModel = new User();

        if ($this->request->getMethod() === 'post') {
            // Validasi input
            if (!$userModel->validateLogin($this->request->getPost())) {
                return redirect()->back()->withInput()->with('errors', $userModel->errors());
            }

            // Cek apakah user ada dalam database
            $user = $userModel->getUserByEmail($this->request->getPost('email'));
            if ($user && password_verify($this->request->getPost('password'), $user['password'])) {
                // Login berhasil, simpan user ke sesi
                session()->set('user', $user);

                // Redirect ke halaman welcome_message
                return redirect()->to('/');
            } else {
                // Login gagal
                return redirect()->back()->withInput()->with('error', 'Login failed. Please check your email and password.');
            }
        }

        // Tampilkan halaman login
        return view('Authentication/login');
    }
}

