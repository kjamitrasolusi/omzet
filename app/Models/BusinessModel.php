<?php

namespace App\Models;

use CodeIgniter\Model;

class BusinessModel extends Model
{
    protected $table = 'app.businesses';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'owner_id',
        'name',
    ];
}