<?php

namespace App\Controllers\Api;


use App\Models\QrScanModel;
use App\Models\ResourceModel;
use App\Models\Tbl_absen_pagi;
use App\Models\UnitModel;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\RESTful\ResourceController;

class Resource extends ResourceController
{
    use ResponseTrait;
    public function jadwal()
    {

        $id = $this->request->getVar('id_user');
        $model = new ResourceModel();
        $data['data'] = $model->get_jadwal($id);
        return $this->respond($data);
    }

    public function banner_promo()
    {
        $model = new ResourceModel();
        $data['data'] = $model->findAll();
        return $this->respond($data);
    }

   

    public function get_unit()
    {
        $idUnit = $this->request->getVar('id_unit');
        $model = new UnitModel();
        $data['data'] = $model->get_unit($idUnit);
        return $this->respond($data);
    }
}
