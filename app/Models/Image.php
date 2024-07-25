<?php

namespace App\Models;

use CodeIgniter\Model;

class Image extends Model
{
    protected $table = 'konten_gambar';
    protected $primaryKey = 'id';
    protected $allowedFields = ['url', 'description'];
}
