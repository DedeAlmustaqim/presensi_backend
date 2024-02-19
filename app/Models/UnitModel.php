<?php

namespace App\Models;

use CodeIgniter\Model;

class UnitModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_unit';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_unit, nm_unit'];

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

    public function get_unit($idUnit,)
    {
        return $this->db->table('tbl_unit')
            ->select('*')
            ->where('id_unit', $idUnit)
            ->get()->getFirstRow();
    }

    function add($data)
    {
        return $this->db
            ->table('tbl_unit')
            ->insert($data);
    }

    function add_qr($data)
    {
        return $this->db
            ->table('tbl_qr_scan')
            ->insert($data);
    }

    function update_unit($data, $id_unit)
    {
        return $this->db
            ->table('tbl_unit')
            ->where('id', $id_unit)
            ->update($data);
    }
}
