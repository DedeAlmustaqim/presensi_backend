<?php

namespace App\Controllers\Api;

use App\Models\BroadcastModel;
use CodeIgniter\RESTful\ResourceController;

class Broadcast extends ResourceController
{
    public function index()
    {
         $model = new BroadcastModel();

         $data['data'] = $model->findAll();
        return $this->respond($data);
    }
}
