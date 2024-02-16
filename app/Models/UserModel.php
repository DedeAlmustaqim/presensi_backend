<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = ['password'];
    protected $allowedFields    = ['id', 'nip', 'name', 'id_unit', 'jabatan', 'email', 'nik'];

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

    public function get_user()
    {
        return $this->db->table('tbl_user')->join('tbl_unit', 'tbl_user.id_unit = tbl_unit.id_unit')->get()->getFirstRow();
    }

    public function get_rekap($id_user, $tahun, $bulan)
    {
        return $this->db->table('tbl_absen')
            ->select('*')

            ->join('tbl_ket_in', 'tbl_absen.id_ket_in = tbl_ket_in.id_ket_in', 'left')
            ->join('tbl_ket_out', 'tbl_absen.id_ket_out = tbl_ket_out.id_ket_out', 'left')
            ->where('tbl_absen.id_user', $id_user)
            ->where('YEAR(tbl_absen.tgl_in)', $tahun)
            ->where('MONTH(tbl_absen.tgl_in)', $bulan)
            ->orderBy('tbl_absen.tgl_in', 'asc')
            ->get()
            ->getResult();
    }

    public function get_ijin($id_user, $tahun, $bulan)
    {
        return $this->db->table('tbl_absen')
            ->select('*')

            ->join('tbl_ket_in', 'tbl_absen.id_ket_in = tbl_ket_in.id_ket_in', 'left')
            ->join('tbl_ket_out', 'tbl_absen.id_ket_out = tbl_ket_out.id_ket_out', 'left')
            ->where('tbl_absen.id_user', $id_user)
            ->where('YEAR(tbl_absen.tgl_in)', $tahun)
            ->where('MONTH(tbl_absen.tgl_in)', $bulan)
            ->where('stts_ijin', 1)
            ->orderBy('tbl_absen.tgl_in', 'asc')
            ->get()
            ->getResult();
    }

    function update_user($data, $username)
    {
        return $this->db
            ->table('tbl_user')
            ->where('username', $username)
            ->update($data);
    }

    function add($data)
    {
        return $this->db
            ->table('users')
            ->insert($data);
    }

    function update_peg($data, $id)
    {
        return $this->db
            ->table('users')
            ->where('id', $id)
            ->update($data);
    }
}
