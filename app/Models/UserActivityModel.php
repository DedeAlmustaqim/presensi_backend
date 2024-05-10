<?php

namespace App\Models;

use CodeIgniter\Model;
use DateTime;

class UserActivityModel extends Model
{

    protected $DBGroup          = 'default';
    protected $table            = 'logger';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = [
        'name','action', 'additional_info', 'created_at'
    ];



    
}
