<?php

namespace App\Models;

use CodeIgniter\Model;
use DateTime;

class DayOffIn extends Model
{

    protected $DBGroup          = 'default';
    protected $table            = 'off_day_in';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = [];
}
