<?php

namespace App\Models;

use CodeIgniter\Model;

class SaleModel extends Model
{
    protected $table = 'app.sales';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'business_id',
        'transaction_date',
        'product_id',
        'customer_id',
        'channel_id',
        'quantity',
        'amount',
    ];
}