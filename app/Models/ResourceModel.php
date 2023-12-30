<?php

namespace App\Models;

use CodeIgniter\Model;

class ResourceModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'tbl_banner_promo';
    protected $primaryKey       = 'id_banner';
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

    public function get_jadwal($idUser)
    {
        return $this->db->table('tbl_qr_scan')
       
        ->select('TIME_FORMAT(tbl_qr_scan.qr_time_in_start,"%H:%i") as qr_time_in_start, 
        TIME_FORMAT(tbl_qr_scan.qr_time_in_end,"%H:%i") as qr_time_in_end,')
        ->select('TIME_FORMAT(tbl_qr_scan.qr_time_out_start,"%H:%i") as qr_time_out_start, 
        TIME_FORMAT(tbl_qr_scan.qr_time_out_end,"%H:%i") as qr_time_out_end,  tbl_unit.nm_unit')
        ->join('tbl_user','tbl_qr_scan.id_unit = tbl_user.id_unit','left')
        ->join('tbl_unit','tbl_qr_scan.id_unit = tbl_unit.id_unit','left')
        ->where('tbl_user.id_user', $idUser)->get()->getFirstRow();
    }

    
    
}
