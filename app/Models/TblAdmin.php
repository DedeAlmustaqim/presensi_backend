<?php

namespace App\Models;

use CodeIgniter\Model;

class TblAdmin extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_admin';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    function add($data)
    {
        return $this->db
            ->table('tbl_admin')
            ->insert($data);
    }

    function update_adm($data, $id_user)
    {
        return $this->db
            ->table('tbl_admin')
            ->where('id_user', $id_user)
            ->update($data);
    }
}
