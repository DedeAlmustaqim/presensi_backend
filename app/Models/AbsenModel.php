<?php

namespace App\Models;

use CodeIgniter\Model;
use DateTime;

class AbsenModel extends Model
{

    protected $DBGroup          = 'default';
    protected $table            = 'tbl_absen';
    protected $primaryKey       = 'id_absen';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;

    protected $allowedFields    = ['tbl_absen.id_absen, 
	tbl_absen.id_user, 
	tbl_absen.tgl_in, 
	tbl_absen.id_ket_in, 
	tbl_absen.jam_in, 
	tbl_absen.tgl_out, 
	tbl_absen.id_ket_out, 
	tbl_absen.jam_out, 
	tbl_absen.created_at'];



    function add($data)
    {
        return $this->db
            ->table('tbl_absen')
            ->insert($data);
    }

    function update_absen($data, $tgl)
    {
        return $this->db
            ->table('tbl_absen')
            ->where('tgl_in', $tgl)
            ->update($data);
    }

    public function get_absen($id, $year, $month)
    {
        return $this->db->table('tbl_absen')
        ->select('tbl_absen.id_absen, 
                  tbl_absen.id_user, 
                  tbl_absen.tgl_in, 
                  tbl_absen.id_ket_in, 
                  tbl_absen.jam_in, 
                  tbl_absen.ket_absen_in, 
                  tbl_absen.bukti, 
                  tbl_absen.tgl_out, 
                  tbl_absen.id_ket_out, 
                  tbl_absen.jam_out, 
                  tbl_absen.ket_absen_out, 
                  tbl_absen.stts_ijin, 
                  tbl_absen.created_at')
        // ->where('tbl_absen.id_user', 75)
        // ->where('YEAR(tbl_absen.created_at)', "2024")
        // ->where('MONTH(tbl_absen.created_at)', "02")
        ->get();
    }

    function update_data($data, $id)
    {
        return $this->db
            ->table('tbl_absen')
            ->where('id_absen', $id)
            ->update($data);
    }
}
