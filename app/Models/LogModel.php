<?php

namespace App\Models;

use CodeIgniter\Model;

class LogModel extends Model
{
    protected $table = 'log';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kode_barang','nama_barang', 'jumlah', 'jenis', 'name', 'purpose', 'reference_number', 'timestamp'];
}
