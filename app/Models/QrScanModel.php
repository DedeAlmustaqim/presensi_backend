<?php

namespace App\Models;

use CodeIgniter\Model;

class QrScanModel extends Model
{
  protected $DBGroup          = 'default';
  protected $table            = 'tbl_qr_scan';
  protected $primaryKey       = 'id';
  protected $useAutoIncrement = true;
  protected $insertID         = 0;
  protected $returnType       = 'array';
  protected $useSoftDeletes   = false;
  protected $protectFields    = true;
  protected $allowedFields    = ['id', 'id_unit', 'qr_pagi', 'qr_sore', 'qr_time_pagi_start', 'qr_time_pagi_end'];

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

  public function check_qr($qr)
  {
    $this->select('qr_in');
    $this->where('tbl_qr_scan', $qr);

    $query = $this->get();
    $num = $query->num_rows();
    if ($num > 0) {
      return FALSE;
    } else {
      return TRUE;
    }
  }

  public function get_jadwal($idUnit)
  {
    return $this->db->table('tbl_qr_scan')->
    select('qr_time_pagi_start,qr_time_pagi_end')
    ->where('id_unit',$idUnit)
    ->get()
    ->getFirstRow();
  }

  function update_qrscan($data, $id_unit)
    {
        return $this->db
            ->table('tbl_qr_scan')
            ->where('id_unit', $id_unit)
            ->update($data);
    }
}
