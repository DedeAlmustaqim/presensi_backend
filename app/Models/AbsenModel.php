<?php

namespace App\Models;

use CodeIgniter\Model;
use DateTime;

class AbsenModel extends Model
{




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
            ->where('tgl_in',$tgl)
            ->update($data);
    }

    public function get_absen_pagi($idUser, $tgl)
    {
        return $this->db->table('tbl_absen')
            ->select('tgl, TIME_FORMAT(jam,"%H:%i") as jam, ket')
            ->where('id_user', $idUser)
            ->where('tgl', $tgl)
            ->get()->getFirstRow();
    }
}
