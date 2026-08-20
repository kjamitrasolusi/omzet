<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
    protected $table = 'app.products';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'business_id',
        'name',
    ];
}