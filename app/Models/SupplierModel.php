<?php

namespace App\Models;

use CodeIgniter\Model;

class SupplierModel extends Model
{
    protected $table = 'suppliers'; // Name of the table
    protected $primaryKey = 'id'; // Primary key
    protected $allowedFields = ['name', 'address', 'phone', 'company']; // Fields that can be inserted/updated
}
