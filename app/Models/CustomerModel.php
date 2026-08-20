<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table = 'app.customers';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'business_id',
        'name',
        'phone',
    ];
}