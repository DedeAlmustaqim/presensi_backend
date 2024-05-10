<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\BannerModel;
use \Hermawan\DataTables\DataTable;

class Logger extends BaseController
{
    protected $akses;
    public function __construct()
    {
        $this->akses = session('akses');
    }

    public function index()
    {
        $data = array(
            'judul' => 'Logger Admin',
            'sub_judul' => '',

        );
        return view('admin/logger', $data);
    }

    public function json_logger()
    {
        $db = db_connect();
        $builder = $db->table('logger')->orderBy('created_at', 'desc');

        return DataTable::of($builder)->toJson();
    }
}
