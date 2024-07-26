<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'kode_barang', 'nama_barang', 'harga_beli', 'harga_jual', 'stok_produk', 'gambar_produk', 'status_produk','satuan'
    ];
}
