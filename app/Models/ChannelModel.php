<?php

namespace App\Models;

use CodeIgniter\Model;

class ChannelModel extends Model
{
    protected $table = 'app.channels';

    protected $primaryKey = 'id';

    protected $returnType = 'array';

    protected $allowedFields = [
        'business_id',
        'name',
    ];
}