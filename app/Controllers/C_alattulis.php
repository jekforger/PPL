<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\M_alattulis;

class C_alattulis extends BaseController
{
    public function create()
    {
        return view('v_create');
    }

    public function display()
    {
        $model = new M_alattulis();
        $data['data_barang'] = $model->orderBy('Kode', 'DESC')->findAll();
        return view('v_alattulis', $data);
    }

    public function delete($id)
    {
        $model = new M_alattulis();
        $model->deleteBarang($id);

        return redirect()->to('/Barang');
    }

    public function view($kode)
    {
    $model = new M_alattulis();
    $data['data_barang'] = $model->where('Kode', $kode)->first();

    if (!$data['data_barang']) {
        return redirect()->to('/Barang');
    }

    return view('v_detail_alat', $data);
    }

    public function edit($id)
    {
        $model = new M_alattulis();
        $data['data_barang'] = $model->getBarangById($id);
    
        if (!$data['data_barang']) {
            return redirect()->to('/Barang')->with('error', 'Data barang tidak ditemukan.');
        }
    
        return view('v_update', $data);
    }
    

public function update($id)
{

    $model = new M_alattulis();
    // Validasi form jika diperlukan
    $validation = \Config\Services::validation();
    $validation->setRules([
        'Nama_Barang' => 'required',
        'Harga' => 'required|numeric'
    ]);

    if (!$this->validate($validation->getRules())) {
        // Jika validasi gagal, kembalikan ke halaman form dengan pesan kesalahan
        return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }

    // Ambil data foto jika diupload
    $existing_barang = $model->getBarangById($id);
    $existing_foto = $existing_barang['Foto'] ?? ''; // Mendapatkan nama file foto yang ada, jika ada

// Ambil data foto jika diupload
    $foto = $this->request->getFile('Foto');
    if ($foto->isValid() && !$foto->hasMoved()) {
    // Pindahkan foto ke direktori yang diinginkan
    $newName = $foto->getRandomName();
    $foto->move('./path/to/upload/directory', $newName);
    } else {
    // Jika tidak ada foto yang diunggah, gunakan nama file foto yang ada
    $newName = $existing_foto; // Gunakan nama file foto yang ada
    }

    // Jika validasi berhasil, update data ke dalam database
    $model = new M_alattulis();
    $data = [
        'Nama_Barang' => $this->request->getPost('Nama_Barang'),
        'Harga' => $this->request->getPost('Harga'),
        'Foto' => $newName  // Simpan nama file foto ke dalam database
        // tambahkan kolom lain sesuai kebutuhan
    ];
    $model->updateBarang($id, $data);

    // Redirect ke halaman yang sesuai setelah pembaruan data berhasil
    return redirect()->to('/Barang')->with('success', 'Data berhasil diperbarui.');
}



public function store()
{
    // Validasi form jika diperlukan
    $validation = \Config\Services::validation();
    $validation->setRules([
        'Kode' => 'required',
        'Nama_Barang' => 'required',
        'Harga' => 'required|numeric'
    ]);

    if (!$this->validate($validation->getRules())) {
        // Jika validasi gagal, kembalikan ke halaman form dengan pesan kesalahan
        return redirect()->back()->withInput()->with('errors', $validation->getErrors());
    }

    // Ambil data foto jika diupload
    $foto = $this->request->getFile('Foto');
    if ($foto->isValid() && !$foto->hasMoved()) {
        // Pindahkan foto ke direktori yang diinginkan
        $newName = $foto->getRandomName();
        $foto->move('./path/to/upload/directory', $newName);
    } else {
        // Atau Anda dapat menangani jika foto tidak diunggah
        // Misalnya, menetapkan nama file default
        $newName = 'default.jpg';
    }

    // Jika validasi berhasil, simpan data ke dalam database
    $model = new M_alattulis();
    $data = [
        'Kode' => $this->request->getPost('Kode'),
        'Nama_Barang' => $this->request->getPost('Nama_Barang'),
        'Harga' => $this->request->getPost('Harga'),
        'Foto' => $newName  // Simpan nama file foto ke dalam database
        // tambahkan kolom lain sesuai kebutuhan
    ];
    $model->insert($data);

    // Redirect ke halaman yang sesuai setelah pembuatan data berhasil
    return redirect()->to('/Barang')->with('success', 'Data berhasil ditambahkan.');
}

    

}
