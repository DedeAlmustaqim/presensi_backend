<?php

namespace App\Models;

use CodeIgniter\Model;

class CutiModel extends Model
{
    protected $table = 'tbl_cuti';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id_user',
        'no_surat',
        'id_ket',
        'start_date',
        'end_date',
        'subtraction'
    ];

    public function getCutiByMonth($month)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);

        $builder->select('id, id_user, no_surat, id_ket, start_date, end_date, subtraction');
        $builder->where("((YEAR(start_date) = YEAR(end_date) AND MONTH(start_date) <= $month AND MONTH(end_date) >= $month) 
                          OR (YEAR(start_date) <> YEAR(end_date) AND (MONTH(start_date) <= $month OR MONTH(end_date) >= $month)))");

        $query = $builder->get();
        return $query->getResult();
    }

    public function countCutiByMonth($id,$month, $kondisi)
    {
        $db = \Config\Database::connect();
        $builder = $db->table($this->table);

        $builder->select('COUNT(*) as jumlah_baris, SUM(subtraction) as total_subtraction');
        $builder->where('id_user',$id);
        $builder->where('id_ket',$kondisi);
        $builder->where("((YEAR(start_date) = YEAR(end_date) AND MONTH(start_date) <= $month AND MONTH(end_date) >= $month) 
                          OR (YEAR(start_date) <> YEAR(end_date) AND (MONTH(start_date) <= $month OR MONTH(end_date) >= $month)))");

        $query = $builder->get();
        return $query->getRow();
    }
}
