<?php

namespace App\Models;

use CodeIgniter\Model;

class M_alattulis extends Model
{
    protected $table = 'data_barang';
    protected $allowedFields = ['id', 'Kode', 'Nama_Barang', 'Harga', 'Foto', 'Aksi'];

    public function deleteBarang($id)
    {
        return $this->where('id', $id)->delete();
    }

    public function getBarangById($id)
    {
        return $this->where('id', $id)->first();
    }

    public function updateBarang($id, $data)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id', $id);
        return $builder->update($data);
    }

    public function createBarang($data)
    {
        return $this->insert($data);
    }
}
